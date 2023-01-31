<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\MobileController;
use App\Http\Controllers\CouponCodeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TimeAvailableController;
use App\Http\Controllers\LeadTimeController;
use App\Http\Controllers\AddOnController;
use App\Http\Controllers\ServicesController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

use App\Http\Controllers\WarrentyController;

Route::resource('users', UserController::class, ['except' => ['create', 'edit']]);
use Barryvdh\DomPDF\Facade\Pdf;


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

Route::get('/', function () {
    return view('auth.login');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



// mobile 
Route::get('/add-new-mobile', function () {
    return view('Admin.add_mobile');
})->middleware(['auth'])->name('add.mobile');
Route::post('/insert-mobile',[MobileController::class,'store'])->middleware(['auth']);
Route::get('/mobile-list',[MobileController::class,'Allmobile'])->middleware(['auth'])->name('all-mobile');
Route::get('mobile.delete/{id}',[MobileController::class,'delete'])->name('mobile.delete');
Route::get('mobile.edit/{id}',[MobileController::class,'edit'])->name('mobile.edit');
Route::post('update-mobile/{id}',[MobileController::class,'update'])->name('mobile.update');



// add on's

Route::get('/add-new-addon', function () {
    return view('Admin.add_on');
})->middleware(['auth'])->name('add.add_on');

Route::post('/insert-addon',[AddOnController::class,'store'])->middleware(['auth']);
Route::get('/addon-list',[AddOnController::class,'AllAddOn'])->middleware(['auth'])->name('all-addon');
Route::get('addon.delete/{id}',[AddOnController::class,'destroy'])->name('addon.delete');
Route::get('addon.edit/{id}',[AddOnController::class,'edit'])->name('addon.edit');
Route::post('update-addon/{id}',[AddOnController::class,'update'])->name('addon.update');

// warrenty 
// Route::get('/add-new-warrenty', function () {
//     return view('Admin.add_on_warrenty');
// })->middleware(['auth'])->name('add.add_on_warrenty');

// Route::post('/insert-warrenty',[WarrentyController::class,'store'])->middleware(['auth']);
// Route::get('/warrenty-list',[WarrentyController::class,'AllWarrenty'])->middleware(['auth'])->name('all-warrenty');
// Route::get('warrenty.delete/{id}',[WarrentyController::class,'destroy'])->name('warrenty.delete');
// Route::get('warrenty.edit/{id}',[WarrentyController::class,'edit'])->name('warrenty.edit');
// Route::post('update-warrenty/{id}',[WarrentyController::class,'update'])->name('warrenty.update');

// servicess

// Route::get('/add-new-service', function () {
//     return view('Admin.add_service');
// })->middleware(['auth'])->name('add.service');

// Route::post('/insert-service',[ServicesController::class,'store'])->middleware(['auth']);
Route::get('/service-list',[ServicesController::class,'AllService'])->middleware(['auth'])->name('all-service');
// Route::get('service.delete/{id}',[ServicesController::class,'destroy'])->name('service.delete');
Route::get('service.edit/{id}',[ServicesController::class,'edit'])->name('service.edit');
Route::post('update-service/{id}',[ServicesController::class,'update'])->name('service.update');


// coupon code
Route::get('/add-new-couponcode', function () {
    return view('Admin.add_coupon');
})->middleware(['auth'])->name('add.coupon');
Route::post('/insert-Couponcode',[CouponCodeController::class,'store'])->middleware(['auth']);
Route::get('/coupon-list',[CouponCodeController::class,'Allcouponcode'])->middleware(['auth'])->name('all-coupon');
Route::get('coupon.delete/{id}',[CouponCodeController::class,'delete'])->name('coupon.delete');
Route::get('coupon.edit/{id}',[CouponCodeController::class,'edit'])->name('coupon.edit');
Route::post('update-coupon/{id}',[CouponCodeController::class,'update'])->name('coupon.update');

// booking 
Route::get('/booking-list',[BookingController::class,'Allbooking'])->middleware(['auth'])->name('all-booking');


Route::get('/timing-manage', function () {
    return view('Admin.timing_manage');
});

Route::post('/insert-timing',[TimeAvailableController::class,'update'])->middleware(['auth']);

Route::get('/timing-availability',[TimeAvailableController::class,'Timeshow'])->middleware(['auth'])->name('timing-availability');


Route::post('update-leadtime/{id}',[LeadTimeController::class,'update'])->name('leadtime.update');
Route::get('/timing-manage',[LeadTimeController::class,'index'])->middleware(['auth'])->name('all-leadtime');
Route::post('/insert-leadtime/{id}',[LeadTimeController::class,'update'])->middleware(['auth']);

