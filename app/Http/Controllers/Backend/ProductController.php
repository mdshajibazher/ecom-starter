<?php

namespace App\Http\Controllers\Backend;

use DB;
use Carbon;
use Session;
use Validator;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Collection;
use App\Models\ProductImage;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use App\Models\Subcollection;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    use ProductTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $variants = Variant::all();
        $products=Product::with('prices.variant_one','prices.variant_two','prices.variant_three')->paginate(10);
        return view('backend.products.index',compact('products','variants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        $subcollections = Subcollection::all();
        return view('backend.products.create', compact('variants','subcollections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->data_validate($request);

        DB::beginTransaction();
        try {
            $product=Product::create([
                'title'=>$request['title'],
                'sku'=>$request['sku'],
                'description'=>$request['description']
            ]);

            $product_id = $product->id;
    
            $imagepath=$this->uploadImage($request);
            foreach ($imagepath as $key => $value) {
                ProductImage::create([
                    'product_id'=>$product_id,
                    'file_path'=>$value,
                ]);
            }
            $product_variant_ids=$this->insertProductVariant($request,$product_id);
            $this->insertProductVariantPrices($request,$product_variant_ids,$product_id);
            $this->AttachSubcollection($request, $product);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        
        
        
            
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function search($query_field,$query,Request $request)
    {
        //if request has per_page then ok otherwise set static value 10;
        $paginate_perpage = $request->per_page ? $request->per_page : 10;
        $orderBy = $request->orderBy ? $request->orderBy : 'id';
        $orderByDir = $request->orderByDir ? $request->orderByDir : 'desc';
        return Product::with('prices.variant_one','prices.variant_two','prices.variant_three')->where($query_field,'LIKE',"%$query%")->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);
    }

    public function show($product)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('Subcollections')->findOrFail($id);
        $data['variants'] = Variant::all();
        $data['product']=$product;
        $data['product']['product_variants']=ProductVariant::where('product_id',$product->id)->get()->groupBy('variant_id');
        $data['prices']=$product->load('prices.variant_one','prices.variant_two','prices.variant_three');
        $data['images']=$product->load('images');
        $data['subcollections']=Subcollection::all();
   
        return view('backend.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product_id=$product->id;
        $this->data_validate($request, $product_id);
        DB::beginTransaction();

        try {
            $product->update([
                'title' =>$request->title,
                'sku' =>$request->sku,
                'description' =>$request->description,
            ]);

            if ($request->editImage) {
                $allimages=$product->load('images');
                foreach ($allimages->images as $key => $value) {
                    unlink(public_path('images/'.$value->file_path));
                }
                $product->images()->delete();
                $imagepath=$this->uploadImage($request);
                foreach ($imagepath as $key => $value) {
                    ProductImage::create([
                        'product_id'=>$product_id,
                        'file_path'=>$value,
                    ]);
                }
            }

            $ids=array_column($request->product_variant, 'option');
            $product->productvariants()->detach($ids);
            $product_variant_ids=$this->insertProductVariant($request,$product_id);

            $product->prices()->delete();
            $this->insertProductVariantPrices($request,$product_variant_ids,$product_id);
            $this->SyncSubcollection($request,$product);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Product $product)
    {
        //
    }

    public function getProducts(Request $request){
        $paginate_perpage = $request->per_page ? $request->per_page : 10;
        $orderBy = $request->orderBy ? $request->orderBy : 'id';
        $orderByDir = $request->orderByDir ? $request->orderByDir : 'desc';
        return Product::with('prices.variant_one','prices.variant_two','prices.variant_three')->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);
    }
}
