<?php
namespace App\Traits;

use Image;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\ProductVariantCombination;

trait ProductTrait{

	public function uploadImage(Request $files,$id=null)
    {
    	$imageName=$files->product_image;
        $images=[];
    	foreach ($imageName as $key => $value) {
    		$images[]=$this->imageprocess($value);
    	}
        return $images;
    }

    public function imageprocess($image)
	{
	    $exploed1 = explode(";", $image);
	    $exploed2 = explode("/", $exploed1[0]);
	    $filename =  uniqid().'.'.$exploed2[1];
	    Image::make($image)->save(public_path('images/products/original/'.$filename));
	    Image::make($image)->fit(440, 586)->save(public_path('images/products/resized/'.$filename));
	    Image::make($image)->fit(215, 215)->save(public_path('images/products/thumb/'.$filename));
	    return $filename;
	}


    public function AttachSizes($request, $product){
        $sizes_pivot_data = [];
        foreach($request->sizes as $size){
         $sizes_pivot_data[] = ['product_id'=> $product->id, 'size_id' =>$size['id']];   
        }

        $product->Sizes()->attach($sizes_pivot_data);
    }

    public function SyncSizes($request, $product){
        $sizes_pivot_data = [];
        foreach($request->sizes as $size){
         $sizes_pivot_data[] = ['product_id'=> $product->id, 'size_id' =>$size['id']];   
        }
        $product->Sizes()->detach();
        $product->Sizes()->attach($sizes_pivot_data);
    }

    public function AttachColors($request, $product){
        $colors_pivot_data = [];
        foreach($request->colors as $color){
         $colors_pivot_data[] = ['product_id'=> $product->id, 'color_id' =>$color['id']];   
        }

        $product->Colors()->attach($colors_pivot_data);
    }

    public function SyncColors($request, $product){
        $colors_pivot_data = [];
        foreach($request->colors as $color){
         $colors_pivot_data[] = ['product_id'=> $product->id, 'color_id' =>$color['id']];   
        }
        $product->Colors()->detach();
        $product->Colors()->attach($colors_pivot_data);
    }



    public function AttachSubcollection($request, $product){
        $subcol_id = [];
        foreach($request->sub_collections as $sub){
         $subcol_id[] = ['product_id'=> $product->id, 'subcollection_id' =>$sub['id']];   
        }

        $product->Subcollections()->attach($subcol_id);
    }


    public function SyncSubcollection($request, $product){
        $subcol_id = [];
        foreach($request->sub_collections as $sub){
         $subcol_id[] = ['product_id'=> $product->id, 'subcollection_id' =>$sub['id']];   
        }

        $product->Subcollections()->detach();
        $product->Subcollections()->attach($subcol_id);
    }


    public function insertProductVariantCombinations($request,$product_id)
    {
        foreach ($request->variant_combinations as $key => $combination) {
            ProductVariantCombination::insert([
                'label' => $combination['combination'],
                'product_id' => $product_id,
                'size_id' => $combination['size']['id'],
                'color_id' => $combination['color']['id'],
                'price' => $combination['price'],
                'stock' => $combination['stock'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // $prices=$request->product_variant_prices;
        // $cross_products=collect($product_variant_ids[0]);

        // if (array_key_exists(1,$product_variant_ids) && array_key_exists(2,$product_variant_ids)) {
        //     $cross_products=$cross_products->crossJoin($product_variant_ids[1],$product_variant_ids[2]);
        // }elseif (array_key_exists(1,$product_variant_ids)) {
        //     $cross_products=$cross_products->crossJoin($product_variant_ids[1]);
        // }
        // if (count($product_variant_ids) < 2) 
        // {
        //     foreach ($cross_products as $index => $value) {
        //         ProductVariantPrice::insert([
        //             $this->variants[$index]=>$value,
        //             'price'=>$prices[$index]['price'],
        //             'stock'=>$prices[$index]['stock'],
        //             'product_id'=>$product_id
        //          ]);
        //     }
        // }
        // else
        // {
        //     //return count($product_variant_ids);
        //     $product_prices=collect([]);
        //     foreach ($cross_products as $key => $cross_product) {
        //         $vrnt=[];
        //         foreach ($cross_product as $tk => $tv) {
        //             $vrnt[$this->variants[$tk]]=$tv;
        //         }
        //         $product_prices[$key]=array_merge($vrnt,[
        //                 'price'=>$prices[$key]['price'],
        //                 'stock'=>$prices[$key]['stock'],
        //                 'product_id'=>$product_id
        //             ]);
        //     }
        //     ProductVariantPrice::insert($product_prices->toArray());
        //     return response()->json(['success'=>true,200]);
        // }
    }

    private function data_validate($request,$id=null)
    {
        ($id == null) ?  $img_validation =  ['required','array','min:1'] : $img_validation =  [];
     
        $this->validate($request, [
            'title' => 'bail|required|string|max:100',
            'sku' => 'bail|required|max:100|unique:products,sku,'.($id!=null?$id:''),
            'description' => 'required',
            'sizes' => 'required',
            'colors' => 'required',
            'collection' => 'required',
            'variant_combinations' => 'required',
            'product_image' =>  $img_validation,
            'product_image.*' => 'required',
            'sub_collections' => 'required',
        ],
        );
    }
}