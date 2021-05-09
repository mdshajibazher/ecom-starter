<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function Home(){
        $products = Product::with('images','Subcollections')->get();
        return view('frontend.pages.home',compact('products'));
    }

    public function ProductDetails($id){
        $products = Product::with('variants','productvariants','prices.variant_one','prices.variant_two','prices.variant_three','images','Subcollections')->findOrFail($id);
        return $products;
    }
}
