<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});
Route::get('/','HomePageController@index');
Route::get('/home','HomePageController@index');
Route::get('/about-us','HomePageController@about_us');
Route::get('/contact-us','HomePageController@contact_us');
Route::get('/category','HomePageController@category');
Route::get('/product-list','HomePageController@productList');
Route::get('/product/{name}','HomePageController@productDetails');
Route::get('/product-details','HomePageController@productDetails');
Route::get('/faq','HomePageController@faq');
Route::get('/login','HomePageController@login');
Route::post('/save-about','HomePageController@saveAbout');
Route::get('/page/{name}','HomePageController@page');
Route::get('/purchase-course/{name}/{id}','HomePageController@purchaseCourse');
Route::post('/join-class','HomePageController@saveClassData');
Route::get('/complete-payment/{name}/{id}/{insid}','HomePageController@completePayment');
Route::post('/payment','StripeController@stripePost');
Route::get('/payment-status','HomePageController@paymentStatus');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('cart', 'CartController@cartList')->name('cart.list');
Route::post('cart', 'CartController@addToCart')->name('cart.store');
Route::post('update-cart','CartController@updateCart')->name('cart.update');
Route::post('remove','CartController@removeCart')->name('cart.remove');
Route::post('clear', 'CartController@clearAllCart')->name('cart.clear');
Route::get('checkout', 'CartController@checkout')->name('cart.checkout');
Route::post('process-order', 'CartController@processOrder')->name('cart.process-order');
Route::get('account', 'DashboardController@account')->name('account');
Route::get('order-history', 'DashboardController@orderHistory')->name('order-history');
Route::post('pofile-update', 'DashboardController@profileUpdate');
Route::get('change-password', 'DashboardController@changePassword')->name('change-password');
Route::post('update-password', 'DashboardController@updatePassword');
Route::get('order-list', 'DashboardController@orderList')->name('order-list');
Route::get('wishlist', 'DashboardController@wishlist')->name('wishlist');
Route::get('add-to-wishlist/{name}', 'DashboardController@saveWishList');
