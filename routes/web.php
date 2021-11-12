<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SslCommerzPaymentController;
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
Route::get('/', [FrontendController::class, 'index'])->name('index')->middleware('phone');
Route::post('/search/area_info', [FrontendController::class, 'area_search'])->name('search.area_info');
Route::get('/hotels' , [FrontendController::class , 'search_hotels'])->name('search.hotels');
Route::get('/details/{id}' , [FrontendController::class , 'details'])->name('details');
Route::post('/store/cart', [FrontendController::class, 'store_cart'])->name('store.cart');
Route::get('/checkout', [FrontendController::class, 'checkout_page'])->name('checkout');

Route::get('/blog/show/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('policy/{type}', [FrontendController::class, 'get_policy'])->name('get_policy');

Route::get('/auth/google', [SocialLoginController::class, 'googleRedirect'])->name('google.login');
Route::get('/auth/google/callback', [SocialLoginController::class, 'googleCallback'])->name('google.login');
Route::get('/auth/google/phone' , [SocialLoginController::class , 'googlePhone'])->name('google.phone');

Route::post('/resend-otp' , [UserController::class , 'resend_otp'])->name('resend.otp');
Route::get('/send-otp', [UserController::class, 'send_otp'])->name('send_otp');
Route::get('/verification', [UserController::class, 'otp_verification'])->name('verification');
Route::get('/match-otp', [UserController::class, 'match_otp'])->name('match-otp');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::group(['middleware'=>['auth:sanctum', 'phone']], function (){

    //sslzcommerz
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('ssl_pay.ajax');

    Route::get('/hotel/favourite-list', [HomeController::class, 'hotel_favourite_list'])->name('hotel_favourite_list');
    Route::post('/make-favourite/{userId}', [UserController::class, 'make_favourite'])->name('make_favourite');
    Route::post('/make-unfavourite/{hotelId}', [UserController::class, 'make_un_favourite'])->name('make_un_favourite');

    Route::group(['prefix'=>'/user', 'as'=>'user.'], function (){
        Route::get('/booking-list', [HomeController::class, 'booking_list'])->name('booking.list');
        Route::get('/booking/{invoice_id}/invoice', [HomeController::class, 'booking_invoice'])->name('booking.invoice');

        Route::get('rating/list', [RatingController::class, 'index'])->name('rating.index');
        Route::get('booking/{booking}/rating/add', [RatingController::class, 'create'])->name('rating.create');
        Route::post('booking/{booking}/rating/store', [RatingController::class, 'store'])->name('rating.store');
    });
});

//sslzcommerz
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('ssl_pay.ajax');
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

//sslzcommerz
