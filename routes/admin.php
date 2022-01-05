<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['middleware'=> 'PreventBackHistory'])->group(function(){
  Auth::routes(['verify' => true]);
});
Route::middleware(['middleware'=> 'PreventBackHistory'])->group(function(){
  Auth::routes(['verify' => true]);
});
Route::group(['prefix'=>'admin', 'middleware'=>['web']], function(){
  Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings');
});
Route::group(['prefix'=>'admin','middleware'=> ['isAdmin','auth', 'PreventBackHistory']], function(){
  Route::resource('category', 'CategoryController', ['names' => 'category']);
  Route::delete('cat_delete', "CategoryController@cat_delete")->name('admin.category-delete');
  Route::post('/category/featured', 'CategoryController@updateActive')->name('admin.category.active');
  Route::resource('brand', 'BrandController', ['names' => 'brand']);
  Route::delete('brand_delete', "BrandController@brand_delete")->name('admin.brand-delete');
  Route::post('/brand/featured', 'BrandController@updateActive')->name('admin.brand.active');
  Route::resource('product', 'ProductController', ['names' => 'product']);
  Route::delete('product_delete', "ProductController@product_delete")->name('admin.product-delete');
  Route::post('/product/featured', 'ProductController@updateActive')->name('admin.product.active');
});

