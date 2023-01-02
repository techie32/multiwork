<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\CouponCodeController;
use App\Http\Controllers\TimeAvailableController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/booking',[BookingController::class,'index']);

Route::get('/booking/{id}',[BookingController::class,'show']);
Route::post('/booking',[BookingController::class,'store']);
// Route::delete('/booking/{id}',[BookingController::class,'destroy']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/mobileinfo',[MobileController::class,'index']);

Route::get('/mobileinfo/{id}',[MobileController::class,'show']);
Route::post('/mobileinfo',[MobileController::class,'store']);


Route::get('/couponcode',[CouponCodeController::class,'index']);


Route::get('/timing-slot/{dayname}',[TimeAvailableController::class,'cal']);
