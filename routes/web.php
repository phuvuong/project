<?php

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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//Shop
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::get('/danh-muc-san-pham/{category_id}','CategoryController@show_category_home')->name('show-category-home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@shop_detail')->name('shop-detail');



//Cart
Route::post('/add-cart','CartController@add_cart');
Route::get('/show-cart','CartController@show_cart');
Route::post('/update-cart','CartController@update_cart');
Route::get('/delete-cart/{session_id}','CartController@delete_cart');
Route::get('/delete-all-cart','CartController@delete_all_cart');
Route::post('/select-delivery-home','CartController@select_delivery_home');
Route::post('/calculate-fee','CartController@calculate_fee');

//Coupon
Route::post('/check-coupon','CartController@check_coupon');

Route::get('/add-coupon','CouponController@add_coupon')->name('add-coupon');
Route::post('/add-coupon','CouponController@save_coupon')->name('save-coupon');
Route::get('/show-coupon','CouponController@show_coupon')->name('show-coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/unset-coupon','CouponController@unset_coupon');

//Delivery 
Route::get('/add-delivery','DeliveryController@add_delivery')->name('add-delivery');
Route::post('/save-delivery','DeliveryController@save_delivery')->name('save-delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::get('/show-delivery','DeliveryController@show_delivery')->name('show-delivery');
Route::get('/delete-delivery/{fee_id}','DeliveryController@delete_delivery');

//Checkout
Route::get('/login-checkout','CheckoutController@login_checkout')->name('login-checkout');
Route::post('/add-customer','CheckoutController@add_customer')->name('add-customer');
Route::post('/login-customer','CheckoutController@login_customer')->name('login-customer');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::get('/checkout','CheckoutController@checkout')->name('checkout');
// Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
// Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::post('/confirm-order','CheckoutController@confirm_order');




//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');


//Order
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::post('/update-order-qty','OrderController@update_order_qty');


Route::get('/register-auth','AuthController@register_auth');
Route::post('/register','AuthController@register');
Route::get('/login-auth','AuthController@login_auth');
Route::post('/login','AuthController@login');
Route::get('/logout-auth','AuthController@logout_auth');


//Category 
Route::get('/add-category','CategoryController@add_category')->name('add-category');
Route::post('/add-category','CategoryController@save_category')->name('save-category');
Route::get('/show-category','CategoryController@show_category')->name('show-category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category')->name('edit-category');
Route::post('/update-category/{category_id}','CategoryController@update_category')->name('update-category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category')->name('delete-category');

//Brand 
Route::get('/add-brand','BrandController@add_brand')->name('add-brand');
Route::post('/add-brand','BrandController@save_brand')->name('save-brand');
Route::get('/show-brand','BrandController@show_brand')->name('show-brand');
Route::get('/edit-brand/{brand_id}','BrandController@edit_brand')->name('edit-brand');
Route::post('/update-brand/{brand_id}','BrandController@update_brand')->name('update-brand');
Route::get('/delete-brand/{brand_id}','BrandController@delete_brand')->name('delete-brand');

//Product 


//User 

Route::group(['middleware' => 'roles','roles'=>['admin','author']  ], function() {
    Route::get('/add-product','ProductController@add_product')->name('add-product')->middleware('role:admin');
    Route::post('/add-product','ProductController@save_product')->name('save-product');
    Route::get('/show-product','ProductController@show_product')->name('show-product');
    Route::get('/edit-product/{product_id}','ProductController@edit_product')->name('edit-product');
    Route::post('/update-product/{product_id}','ProductController@update_product')->name('update-product');
    Route::get('/delete-product/{product_id}','ProductController@delete_product')->name('delete-product');
});

Route::get('/user','UserController@index');
Route::post('assign-roles','UserController@assign_roles');
Route::get('/delete-user-roles/{admin_id}','UserController@delete_user_roles');