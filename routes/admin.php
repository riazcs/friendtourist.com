<?php

use App\Http\Controllers\HotelManagementController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::prefix('hotel')->as('hotel.')->group(function () {
        Route::get('/hotels', [HotelManagementController::class, 'index'])->name('index');
        Route::post('/store', [HotelManagementController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [HotelManagementController::class, 'delete'])->name('delete');
        Route::post('/update', [HotelManagementController::class, 'update'])->name('update');
    });

    Route::prefix('amenity')->as('amenity.')->group(function () {
        Route::get('/', [AmenityController::class, 'index'])->name('index');
        Route::post('/store', [AmenityController::class, 'store'])->name('store');
        Route::post('/destroy/{id}', [AmenityController::class, 'destroy'])->name('destroy');
        Route::post('/edit', [AmenityController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AmenityController::class, 'update'])->name('update');
        Route::get('/get_property_related_amenity/{type}', [AmenityController::class, 'get_property_related_amenity'])->name('get_property_related_amenity');
    });
    Route::prefix('setting')->as('setting.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::post('/store', [SettingsController::class, 'store'])->name('store');
        Route::post('/update/{id}', [SettingsController::class, 'update'])->name('update');
        Route::post('/destroy/{id}', [SettingsController::class, 'destroy'])->name('destroy');
        Route::get('/property-type/{type}', [SettingsController::class, 'property_type_setting'])->name('property_type_setting');
        Route::get('/get-district', [SettingsController::class, 'get_district'])->name('get_district');
        Route::get('/favourite-area', [SettingsController::class, 'favourite_area'])->name('favourite_area');
        Route::post('/add-favourite-area', [SettingsController::class, 'add_favourite_area'])->name('add_favourite_area');
        Route::post('/delete_area/{id}', [SettingsController::class, 'delete_area'])->name('delete_area');
        Route::resource('coupons', CouponController::class)->names('coupons')->except('show','update');
        Route::post('/update/{id}', [CouponController::class, 'update'])->name('coupons.update');
    });
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/list',[SettingsController::class,'get_user_list'])->name('user_list');
        Route::post('/change-user-status/{id}',[SettingsController::class,'change_user_status'])->name('status.update');
    });
    Route::resource('faq',FaqController::class)->names('faq')->except('update');
    Route::post('/update/{id}', [FaqController::class, 'update'])->name('faq.update');

    Route::resource('blog',BlogController::class)->names('blog')->except('show','update');
    Route::post('/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/show/{id}', [BlogController::class, 'show_details'])->name('blog.show_details');
    Route::get('/blog-type', [BlogController::class, 'blog_type'])->name('blog.type');
    Route::post('/add-blog-type', [BlogController::class, 'add_blog_type'])->name('blog.add_blog_type');
    Route::post('/upload-blog-photos', [BlogController::class, 'upload_blog_photos'])->name('blog.upload_blog_photos');

    Route::get('/terms-policy', [SettingsController::class, 'terms_policy'])->name('terms_policy');
    Route::get('/get-terms-policy/{type}', [SettingsController::class, 'get_terms_policy'])->name('get.terms_policy');
    Route::post('/store-terms-policy', [SettingsController::class, 'store_terms_policy'])->name('store.terms_policy');
    Route::get('/social-link', [SettingsController::class, 'social_link'])->name('social_link');
    Route::post('/store-social-link', [SettingsController::class, 'store_social_link'])->name('store.social_link');
    Route::post('/delete_social_link/{id}', [SettingsController::class, 'delete_social_link'])->name('delete_social_link');
});
