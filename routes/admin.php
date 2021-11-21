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
Route::group(['prefix'=>'admin', 'middleware'=>['web']], function(){
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings');
});

    // Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings');

