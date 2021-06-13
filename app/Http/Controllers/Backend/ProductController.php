<?php

namespace App\Http\Controllers\Backend;

use DB;
use Carbon;
use Session;
use Validator;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Collection;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use App\Models\Subcollection;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
        $products=Product::with('prices.color','prices.size')->paginate(10);
        return view('backend.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $subcollections = Subcollection::all();
        $collections = Collection::all();
        return view('backend.products.create', compact('colors','sizes','subcollections','collections'));
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
                'description'=>$request['description'],
                'collection_id'=> $request['collection']['id'],
            ]);

            $product_id = $product->id;
            $imagepath=$this->uploadImage($request);
            foreach ($imagepath as $key => $value) {
                ProductImage::create([
                    'product_id'=>$product_id,
                    'file_path'=>$value,
                ]);
            }

            $this->insertProductVariantCombinations($request,$product_id);
            $this->AttachSubcollection($request, $product);
            $this->AttachSizes($request, $product);
            $this->AttachColors($request, $product);
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
        return Product::with('prices.color','prices.size')->where($query_field,'LIKE',"%$query%")->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('Collection','Subcollections','Sizes', 'Colors')->findOrFail($id);
        $data['colors'] = Color::all();
        $data['sizes'] = Size::all();
        $data['product']=$product;
        $data['prices']=$product->load('prices.color','prices.size');
        $data['images']=$product->load('images');
        $data['subcollections']=Subcollection::all();
        $data['collections']=Collection::all();
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
                'collection_id'=> $request['collection']['id'],
            ]);

            if ($request->product_image) {
                $imagepath=$this->uploadImage($request);
                foreach ($imagepath as $key => $value) {
                    ProductImage::create([
                        'product_id'=>$product_id,
                        'file_path'=>$value,
                    ]);
                }
            }
            $product->prices()->delete();
            $this->insertProductVariantCombinations($request,$product_id);
            $this->SyncSubcollection($request,$product);
            $this->SyncSizes($request, $product);
            $this->SyncColors($request, $product);

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
        return Product::with('prices.color','prices.size')->orderBy($orderBy,$orderByDir)->paginate($paginate_perpage);
    }

    public function deleteImages($id){
        $productImage = ProductImage::where('product_id', $id)->get();
        foreach ($productImage as $key => $value) {
            $thumb_location = 'images/products/thumb/'.$value->file_path;
            $original_location = 'images/products/original/'.$value->file_path;
            $resized_location = 'images/products/resized/'.$value->file_path;

            if (File::exists($thumb_location)) {
                File::delete($thumb_location);
            }

            if (File::exists($original_location)) {
                File::delete($original_location);
            }

            if (File::exists($resized_location)) {
                File::delete($resized_location);
            }

           $result =  ProductImage::where('id', $value->id)->delete();
        }
        return "Product Image Deleted Successfully";
    }

    public function uploadTempImage(Request $request){
        if($request->old_image){
            //Old Image Location
            $old_original_location = 'images/products/variant/original/'.$request->old_image;
            $old_resized_location = 'images/products/variant/resized/'.$request->old_image;
            $old_thumb_location = 'images/products/variant/thumb/'.$request->old_image;

            //Delete Old Image
            if (File::exists($old_original_location)) {
                File::delete($old_original_location);
            }
            if (File::exists($old_resized_location)) {
                File::delete($old_resized_location);
            }
            if (File::exists($old_thumb_location)) {
                File::delete($old_thumb_location);
            }
        }
        if($request->variant_image){
            $image = $request->variant_image[0];
            $image_position = strpos($request->variant_image[0], ';');
            $sub= substr($request->variant_image[0], 0 ,$image_position);
            $image_extension =explode('/', $sub)[1];
            $image_name = "variant-".rand(1,1000)."-".time().".".$image_extension;

            $original_location = 'images/products/variant/original/'.$image_name;
            $resized_location = 'images/products/variant/resized/'.$image_name;
            $thumb_location = 'images/products/variant/thumb/'.$image_name;

            Image::make($image)->save($original_location);
            Image::make($image)->fit(440,586)->save($resized_location);
            Image::make($image)->fit(80,80)->save($thumb_location);
            return $image_name;
        }
    }
}
