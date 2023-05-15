<?php

use App\Http\Controllers\api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'api\UserApiController@login');
Route::post('/register', 'api\UserApiController@register');
Route::post('/forgetpassword', 'api\UserApiController@forgetPassword');
Route::post('/sendotp', 'api\UserApiController@sendotp');
Route::post('/resendotp', 'api\UserApiController@resendotp');
Route::post('/checkotp', 'api\UserApiController@checkotp');

Route::get('/settings','api\UserApiController@settings');
Route::get('/sharedSettings','api\UserApiController@sharedSettings');

Route::get('/salon', 'api\UserApiController@singleSalon');
Route::get('/categories', 'api\UserApiController@categories');

Route::get('/coupon', 'api\UserApiController@allCoupon');

Route::get('/banners', 'api\UserApiController@banners');
Route::get('/offers', 'api\UserApiController@offers');

Route::post('/timeslot', 'api\UserApiController@timeSlot');
Route::post('/selectemp', 'api\UserApiController@selectEmp');
Route::get('/workinghours_display', 'api\UserApiController@apiWorkingHours');

Route::middleware('auth:api')->group(function()
{
    Route::get('/profile', 'api\UserApiController@showUser');
    Route::post('/profile/edit', 'api\UserApiController@editUser');
    Route::post('/profile/address/add', 'api\UserApiController@addUserAddress');
    Route::get('/profile/address/remove/{id}', 'api\UserApiController@removeUserAddress');

    Route::post('/checkcoupon', 'api\UserApiController@checkCoupon');

    Route::post('/booking', 'api\UserApiController@booking');

    Route::get('/appointment', 'api\UserApiController@showAppointment');
    Route::get('/appointment/{id}', 'api\UserApiController@singleAppointment');
    Route::get('/appointment/cancel/{id}', 'api\UserApiController@cancelAppointment');

    Route::post('/addreview','api\UserApiController@addReview');
    Route::get('/deletereview/{id}','api\UserApiController@deleteReview');

    Route::post('/changepassword', 'api\UserApiController@changePassword');

    Route::get('/notification', 'api\UserApiController@notification');
    Route::get('/payment_gateway', 'api\UserApiController@payment_gateway');
    Route::get('/delete-account', [UserApiController::class,'deleteAccount']);


});
