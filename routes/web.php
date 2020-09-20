<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/product/view', 'ProductController@addproductview');
Route::post('/add/product/insert', 'ProductController@addproductinsert');
Route::get('/delete/product/{product_id}', 'ProductController@deleteproduct');
Route::get('/edit/product/{product_id}', 'ProductController@editproduct');
Route::post('/edit/product/insert', 'ProductController@editproductinsert');
Route::get('/restore/product/{product_id}', 'ProductController@restoreproduct');
Route::get('/force/delete/product/{product_id}', 'ProductController@forcedeleteproduct');
Route::get('/add/category/view', 'CategoryController@addcategoryview');
Route::post('add/category/insert', 'CategoryController@addcategoryinsert');
Route::get('contact/message/view', 'HomeController@contactmessageview');
Route::get('change/menu/status/{category_id}', 'HomeController@changemenustatus');
Route::get('/add/coupon/view', 'HomeController@addcouponview');
Route::post('coupon/insert', 'CouponController@couponinsert');
Route::get('customer/home', 'CustomerController@customerhome');

Route::get('set/or/change/password', 'CustomerController@setorchangepassword');
Route::post('set/password', 'CustomerController@setpassword');
Route::post('change/password', 'CustomerController@changepassword');
Route::get('my/profile', 'CustomerController@myprofile');
Route::post('my/profile/insert', 'CustomerController@myprofileinsert');

// Frontend routes

Route::get('/','FrontendController@index');
Route::get('contact','FrontendController@contact');
Route::get('about','FrontendController@about');
Route::post('/contact/insert','FrontendController@contactinsert');
Route::get('/product/details/{product_id}','FrontendController@productdetails');
Route::get('/category/wise/product/{category_id}','FrontendController@categorywiseproduct');
Route::get('add/to/cart/{product_id}','FrontendController@addtocart');
Route::get('/cart','FrontendController@cart');
Route::get('/cart/{coupon_name}','FrontendController@cart');
Route::get('delete/from/cart/{cart_id}','FrontendController@deletefromcart');
Route::get('clear/cart','FrontendController@clearcart');
Route::post('update/cart','FrontendController@updatecart');

Route::get('customer/registration','FrontendController@customerregistration')->name('customerregistration');
Route::post('customer/registration/insert','FrontendController@customerregistrationinsert')->name('customerregistrationinsert');

Route::get('login/github', 'GithubController@redirectToProvider');
Route::get('login/github/callback', 'GithubController@handleProviderCallback');

Route::get('login/google', 'GoogleController@redirectToProvider');

Route::post('checkout', 'FrontendController@checkout');
Route::post('/get/city/list', 'FrontendController@getcitylist');
