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
                'image' => $combination['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


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