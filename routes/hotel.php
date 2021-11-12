<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelManagementController;
use App\Http\Controllers\HotelRoomController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HotelReservationController;
use App\Http\Controllers\HomeController;

Route::group(['middleware' => ['web', 'hotel'], 'prefix' => 'hotel', 'as' => 'hotel.'], function () {

    Route::get('/dashboard', [HomeController::class, 'hotel_dashboard'])->name('dashboard');

    Route::get('my-hotel', [HotelManagementController::class, 'my_hotel_details'])->name('my_hotel');
    Route::post('my-hotel/{hotel_id}/update', [HotelManagementController::class, 'update_hotel_info'])->name('my_hotel.update');

    Route::resource('rooms', HotelRoomController::class)->except('show');
    Route::post('/rooms/{id}/amenity/store', [HotelRoomController::class, 'store_room_amenity'])->name('rooms.amenity.store');

    Route::group(['prefix' => 'policy' , 'as' => 'policy.'] , function () {
        Route::get('index', [PolicyController::class, 'index'])->name('index');
        Route::post('update', [PolicyController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'photo'], function () {
        Route::get('/room-photos', [ImageUploadController::class, 'room_photos'])->name('room_photos');
        Route::get('/get-room-photos/{hotelId}/{roomId}', [ImageUploadController::class, 'get_room_photos'])->name('get_room_photos');
        Route::post('/upload_room_photos', [ImageUploadController::class, 'upload_room_photos'])->name('upload_room_photos');
        Route::get('/', [ImageUploadController::class, 'index'])->name('photos.index');
        Route::get('/{type}', [ImageUploadController::class, 'create'])->name('photos.create');
        Route::post('/upload', [ImageUploadController::class, 'upload'])->name('photos.upload');
        Route::post('/destroy/{id}', [ImageUploadController::class, 'destroy'])->name('photos.destroy');
    });

    Route::group(['prefix' => 'amenity' , 'as' => 'amenity.'], function () {
        Route::get('/', [HotelManagementController::class, 'hotel_amenities'])->name('create');
        Route::post('/store', [HotelManagementController::class, 'hotel_amenities_store'])->name('store');
    });

    Route::resource('schedules', ScheduleController::class)->only('index', 'store');

    Route::resource('faq',FaqController::class)->names('faq')->except('update');
    Route::post('/update/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::get('/get-hotel-room-id/{id}', [HotelManagementController::class, 'get_hotel_room_id'])->name('get_hotel_room_id');

    Route::get('reservations', [HotelReservationController::class, 'index'])->name('reservation.index');
    Route::post('reservation/status/update', [HotelReservationController::class, 'booking_status_update'])->name('reservation.status.update');
    Route::get('reservation/{invoice_no}/invoice', [HotelReservationController::class, 'booking_invoice'])->name('reservation.invoice');

});
