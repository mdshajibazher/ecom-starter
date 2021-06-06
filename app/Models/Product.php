<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku','collection_id','description'
    ];

    public function prices()
    {
    	return $this->hasMany(ProductVariantCombination::class);
    }

    public function Sizes(){
    	return $this->belongsToMany(Size::class);
    }

    public function Colors(){
    	return $this->belongsToMany(Color::class);
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
