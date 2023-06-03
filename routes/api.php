<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EscapeRoomController;
use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/test', function () {
    $booking = Booking::factory()->create();
    return $booking;

});
Route::post('/escape-rooms', [EscapeRoomController::class, 'store']);
Route::get('/escape-rooms', [EscapeRoomController::class, 'index']);
Route::get('/escape-rooms/{id}', [EscapeRoomController::class, 'show']);
Route::get('/escape-rooms/{id}/time-slots', [EscapeRoomController::class, 'timeSlots']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings', [BookingController::class, 'index']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);

//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/escape-rooms', function () {
//        return 'başarılı';
//    });
//    Route::get('/escape-rooms/{id}', [EscapeRoomController::class, 'show']);
//    Route::get('/escape-rooms/{id}/time-slots', [EscapeRoomController::class, 'timeSlots']);
//    Route::post('/bookings', [BookingController::class, 'store']);
//    Route::get('/bookings', [BookingController::class, 'index']);
//    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
//});
