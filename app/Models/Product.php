<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku','collection_id','description'
    ];

    public function variants()
    {
    	return $this->hasMany(ProductVariant::class);
    }
    public function productvariants()
    {
        return $this->belongsToMany(Variant::class,'product_variants','product_id','variant_id'); 
    }
    
    public function prices()
    {
    	return $this->hasMany(ProductVariantPrice::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    

    public function Subcollections(){
        return $this->belongsToMany(Subcollection::class);
    }
    public function Collection(){
        return $this->belongsTo(Collection::class);
    }
}
