<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\mobilecontroller;
use App\Http\Controllers\CouponCodeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TimeAvailableController;
use App\Http\Controllers\LeadTimeController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

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

// Route::get('/se',[CustomerController::class,'index']);

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
// Route::get('/timing-availability',[TimeAvailableController::class,'index'])->middleware(['auth'])->name('timing-availability');
Route::get('/timing-availability',[TimeAvailableController::class,'Timeshow'])->middleware(['auth'])->name('timing-availability');
// cal
Route::get('/cal-hour/{dayname}',[TimeAvailableController::class,'cal'])->middleware(['auth']);

Route::post('/insert-leadtime',[LeadTimeController::class,'store'])->middleware(['auth']);
Route::post('update-leadtime/{id}',[LeadTimeController::class,'update'])->name('leadtime.update');
Route::get('/timing-manage',[LeadTimeController::class,'index'])->middleware(['auth'])->name('all-leadtime');

Route::get('/modal', function () {
    return view('Admin.timing_manage');
});