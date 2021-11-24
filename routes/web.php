<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
Route::middleware(['middleware'=> 'PreventBackHistory'])->group(function(){
  Auth::routes(['verify' => true]);
});
// home/frontend route
Route::get('/', function () {
    if(Auth::check() && (Auth::user()->user_type == "admin" || Auth::user()->user_type == "staff")){
        return redirect()->route('admin.dashboard');
    }elseif(Auth::check() && Auth::user()->user_type == "user"){
        return redirect()->route('user.dashboard');
    }else{
        return view('auth/login');
    }
});
// Auth Route
Route::get('/email/verify', 'Auth\VerificationController@emailVerify')->name('verification.notice');
Route::post('/email/verification-notification', 'Auth\VerificationController@emailVerificationNotification')->name('verification.send');
Route::get('/forgot-password','Auth\ForgotPasswordController@forgotPassword')->middleware('guest')->name('password.request');
Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@resetPassword')->middleware('guest')->name('password.reset');
Route::post('/reset-password', 'Auth\ResetPasswordController@resetPasswordUpdate')->middleware('guest')->name('password.update');
Route::get('social-login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('social-login/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

Route::get('/home', 'HomeController@index')->name('home');
// admin route
Route::group(['prefix' =>'admin', 'middleware'=> ['isAdmin','auth', 'PreventBackHistory'] ], function(){
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('profile', 'AdminController@profile')->name('admin.profile');
    Route::get('settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings');
    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login');
    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');
});

// user route
Route::group(['prefix' =>'user', 'middleware'=> ['verified','isUser', 'auth', 'PreventBackHistory'] ], function(){
    Route::get('dashboard', 'UserController@index')->name('user.dashboard');
    Route::get('profile', 'UserController@profile')->name('user.profile');
    Route::get('settings', 'UserController@settings')->name('user.settings');
});

// staff with role and permission route
Route::group(['prefix' =>'admin/staffs', 'middleware'=> ['isAdmin','auth', 'PreventBackHistory'] ], function(){
    Route::resource('staff', 'StaffController', ['names' => 'staff']);
    Route::resource('role', 'RolesController', ['names' => 'role']);
    Route::resource('permission', 'PermissionController', ['names' => 'permission']);
    Route::post('permission-add/{id}', 'PermissionController@permission_add')->name('permission.add');
    Route::get('permission-group-edit/{id}', 'PermissionController@permission_group_edit')->name('permission-group-edit');
    Route::get('permission-group-delete/{id}', 'PermissionController@permission_group_delete')->name('permission-group-delete');
});

// Product, category, brand, attribute route
Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth', 'PreventBackHistory']], function(){
    Route::resource('product', 'ProductController', ['names' => 'product']);
    Route::resource('category', 'CategoryController', ['names' => 'category']);
    Route::resource('brand', 'BrandController', ['names' => 'brand']);
    Route::resource('attribute', 'AttributeController', ['names' => 'attribute']);
});
// project route
Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth', 'PreventBackHistory']], function(){
    Route::resource('project', 'ProjectController', ['names'=>'project']);
    Route::resource('get-payment', 'GetPaymentController', ['names'=>'get-payment']);
    Route::resource('make-payment', 'MakePaymentController', ['names'=>'make-payment']);
    Route::resource('make-order', 'MakeOrderController', ['names'=>'make-order']);
    Route::get('project/get-payment/{id}', 'GetPaymentController@get_payment')->name('project.get-payment');
    Route::get('project/spending/{id}', 'CostController@spending')->name('project.spending');
    Route::resource('project/cost', 'CostController', ['names'=>'project.cost']);
    Route::get('/supply-goods-search', 'CostController@supply_goods_search')->name('project.supply-goods-search');
    Route::resource('workers-list', 'WorkerController', ['names'=>'workers-list']);
    Route::resource('project/expenses', 'ExpenseController', ['names'=>'project.expenses']);
    Route::resource('supplier', 'SupplierController', ['names'=>'supplier']);
});
// page route
Route::get('contact-us', 'ContactController@contact')->name('contact-us');
Route::post('contact/submit', 'ContactController@contact_submit')->name('contact-submit');

