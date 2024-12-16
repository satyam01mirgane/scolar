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
Route::get('/test','HomePageController@sendReminderEmail');
Route::get('/about-us','HomePageController@about_us');
Route::get('/contact-us','HomePageController@contact_us');
Route::get('/workshops','HomePageController@workshops');
Route::get('/courses','HomePageController@courses');
Route::get('/workshops-detail/{name}','HomePageController@workshopDetail');
Route::get('/course-detail/{name}','HomePageController@courseDetail');
Route::get('/services','HomePageController@services');
Route::get('/blogs','HomePageController@blogs');
Route::get('/blog-list/{name}','HomePageController@blogList');
Route::any('/blog-detail/{name}','HomePageController@blogDetail');
Route::post('/comment-add','HomePageController@commentAdd');
Route::post('/send-enquiry','HomePageController@sendEnquiry');
Route::get('/events','HomePageController@events');
Route::get('/login','HomePageController@login')->name('login');
Route::get('/page/{name}','HomePageController@page');
Route::get('complete-payment', 'CartController@completePayment')->name('cart.complete-payment');
Route::post('razorpay-payment','RazorpayPaymentController@store')->name('razorpay.payment.store');
Route::get('/quiz-list','HomePageController@listQuiz');
Route::get('/start-quiz/{name}','HomePageController@startQuiz');
Route::post('/submit-quiz','HomePageController@submitQuiz');

Route::get('/career', [HomePageController::class, 'showCareerPage'])->name('career.page');


Route::get('/test-list','HomePageController@listTest');
Route::get('/start-test/{name}','HomePageController@startTest');
Route::post('/submit-test','HomePageController@submitTest');

Route::post('/getstate','HomePageController@getState');
Route::post('/getcity','HomePageController@getCities');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('cart', 'CartController@cartList')->name('cart.list');
Route::post('cart', 'CartController@addToCart')->name('cart.store');
Route::post('update-cart','CartController@updateCart')->name('cart.update');
Route::post('remove','CartController@removeCart')->name('cart.remove');
Route::post('clear', 'CartController@clearAllCart')->name('cart.clear');
Route::get('checkout', 'CartController@checkout')->name('cart.checkout');
Route::post('process-order', 'CartController@processOrder')->name('cart.process-order');
Route::get('dashboard', 'DashboardController@account')->name('dashboard');
Route::get('profile-edit', 'DashboardController@profileEdit')->name('profile-edit');
Route::get('enrolled-workshop', 'DashboardController@orderList')->name('enrolled-workshop');
Route::get('enrolled-course', 'DashboardController@courseList')->name('enrolled-course');
Route::get('scheduled-workshop', 'DashboardController@scheduledWorkshop')->name('scheduled-workshop');
Route::get('scheduled-course', 'DashboardController@scheduledCourse')->name('scheduled-course');
Route::get('certificate-feedback', 'DashboardController@certificateFeedback')->name('certificate-feedback');
Route::post('pofile-update', 'DashboardController@profileUpdate');
Route::post('feedback', 'DashboardController@feedback');
Route::get('print-certificate/{id}', 'DashboardController@printCertificate');
Route::post('query-submit', 'HomePageController@querySubmit');
Route::get('change-password', 'DashboardController@changePassword')->name('change-password');
Route::post('update-password', 'DashboardController@updatePassword');
Route::get('order-list', 'DashboardController@orderList')->name('order-list');
Route::get('print-invoice/{order}', 'DashboardController@printInvoice');
Route::get('print-course-invoice/{order}', 'DashboardController@printInvoiceCourse');
Route::get('wishlist', 'DashboardController@wishlist')->name('wishlist');
Route::get('add-to-wishlist/{name}', 'DashboardController@saveWishList');
Route::get('complete-payment', 'CartController@completePayment')->name('cart.complete-payment');
Route::get('check-payment-status', 'HomePageController@paymentStatus');
Route::post('razorpay-payment','RazorpayPaymentController@store')->name('razorpay.payment.store');
Route::get('admin-order-list', 'AdminAppOrder1Controller@getOrder')->name('admin-order-list');
Route::get('print-invoice-admin/{order}', 'AdminAppOrder1Controller@getOrderPrint');
Route::post('/save-newsletter','HomePageController@saveNewsletter');
Route::post('/save-popupdata','HomePageController@savePopupData');

