<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontendController::class,'Home'])->name('homepage');
Route::get('/is_logged_in',[FrontendController::class,'isLoggedIn']);
Route::get('/get_cart_items',[FrontendController::class,'getCartItems']);
Route::delete('/remove_cart_item/{product_variant_price_id}',[FrontendController::class,'removeCartItem']);
Route::post('/add_to_cart',[FrontendController::class,'addToCart']);
Route::get('/product_details/{id}',[FrontendController::class,'ProductDetails']);

Auth::routes();
// Socialite routes
Route::group(['as' => 'login.', 'prefix' => 'login', 'namespace' => 'Auth'], function () {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('callback');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Pages route e.g. [about,contact,etc]
Route::get('/{slug}', PageController::class)->name('page');
