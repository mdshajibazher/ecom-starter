<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
	protected $guarded=['id'];

	public function variantLabel(){
		return $this->belongsTo(Variant::class,'variant_id');
	}
	
	
}
