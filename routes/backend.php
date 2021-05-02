<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\LabelController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\VariantController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CollectionController;
use App\Http\Controllers\Backend\MenuBuilderController;
use App\Http\Controllers\Backend\SubcollectionController;

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





Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Product Section


Route::resource('product-variant',VariantController::class);
//subcollections 
Route::resource('subcollections',SubcollectionController::class)->except(['create','edit','show']);
Route::get('/subcollections/{query_field}/{query}', [SubcollectionController::class,'search']);
Route::get('getsubcollections',[SubcollectionController::class,'getSubcollections']);
//collections
Route::resource('collections',CollectionController::class)->except(['create','edit']);
Route::get('getcollections',[CollectionController::class,'getCollection']);
Route::get('/collections/{query_field}/{query}', [CollectionController::class,'search']);
//labels
Route::resource('labels',LabelController::class)->except(['create','edit','show']);
Route::get('/getlabels',[LabelController::class,'getLabels']);
Route::get('/labels/{query_field}/{query}',[LabelController::class,'search']);

Route::resource('product', ProductController::class);
Route::post('search-product', [ProductController::class,'search'])->name('product.search');
Route::post('uploadImage/{id?}', [ProductController::class,'uploadImage'])->name('uploadimg');

// Roles and Users
Route::resource('roles', RoleController::class)->except(['show']);
Route::resource('users', UserController::class);

// Backups
Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
Route::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');

// Profile
Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
Route::post('profile/', [ProfileController::class, 'update'])->name('profile.update');

// Security
Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::post('profile/security', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// Pages
Route::resource('pages', PageController::class)->except(['show']);

// Menu Builder
Route::resource('menus', MenuController::class)->except(['show']);
Route::post('menus/{menu}/order', [MenuController::class, 'orderItem'])->name('menus.order');
Route::group(['as' => 'menus.', 'prefix' => 'menus/{id}/'], function () {
    Route::get('builder', [MenuBuilderController::class, 'index'])->name('builder');
    // Menu Item
    Route::group(['as' => 'item.', 'prefix' => 'item'], function () {
        Route::get('/create', [MenuBuilderController::class, 'itemCreate'])->name('create');
        Route::post('/store', [MenuBuilderController::class, 'itemStore'])->name('store');
        Route::get('/{itemId}/edit', [MenuBuilderController::class, 'itemEdit'])->name('edit');
        Route::put('/{itemId}/update', [MenuBuilderController::class, 'itemUpdate'])->name('update');
        Route::delete('/{itemId}/destroy', [MenuBuilderController::class, 'itemDestroy'])->name('destroy');
    });
});

// Settings
Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
    Route::get('general', [SettingController::class, 'index'])->name('index');
    Route::patch('general', [SettingController::class, 'update'])->name('update');

    Route::get('appearance', [SettingController::class, 'appearance'])->name('appearance.index');
    Route::patch('appearance', [SettingController::class, 'updateAppearance'])->name('appearance.update');

    Route::get('mail', [SettingController::class, 'mail'])->name('mail.index');
    Route::patch('mail', [SettingController::class, 'updateMailSettings'])->name('mail.update');

    Route::get('socialite', [SettingController::class, 'socialite'])->name('socialite.index');
    Route::patch('socialite', [SettingController::class, 'updateSocialiteSettings'])->name('socialite.update');

});
