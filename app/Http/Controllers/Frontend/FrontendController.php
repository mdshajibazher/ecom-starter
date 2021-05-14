<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function Home(){
        $products = Product::with('images','Subcollections')->get();
        return view('frontend.pages.home',compact('products'));
    }

    public function ProductDetails($id){
        $products = Product::with('variants','productvariants','prices.variant_one.variantLabel','prices.variant_two.variantLabel','prices.variant_three.variantLabel','images','Subcollections','collection')->findOrFail($id);
        $is_loggedin = Auth::check();
        return ['products' => $products,'is_logged_in' => $is_loggedin];
    }

    public function isLoggedIn(){
        return Auth::check();
    }
    

    public function addToCart(Request $request){
        if(Auth::check()){
            $cart = Cart::where('product_id', $request->product_id)->where('product_variant_price_id', $request->product_variant_price_id)->where('user_id', Auth::user()->id);

            if ($cart->count()) {
                $cart->increment('qty');
                $cart = $cart->first();
            } else {
                $cart = new Cart;
                $cart->user_id = Auth::user()->id;
                $cart->product_id =$request->product_id;
                $cart->product_variant_price_id = $request->product_variant_price_id;
                $cart->qty = $request->qty;
                $cart->save();
            }
            return $cart;

        }
        abort(403);

    }

    public function removeCartItem($product_variant_price_id){
        if(Auth::check()){
            $remove_item =  Cart::where('user_id',Auth::user()->id)->where('product_variant_price_id', $product_variant_price_id)->delete();
            return $remove_item;
         }
         return [];
    }

    public function getCartItems(){
        if(Auth::check()){
           return  Cart::with('Product','Product.images','ProductVariantPrice.variant_one','ProductVariantPrice.variant_two','ProductVariantPrice.variant_three')->where('user_id',Auth::user()->id)->get();
        }
        abort(403);
    }
}
