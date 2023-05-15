<?php

use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', function () {
    return redirect('admin/login');
});
Route::post('saveEnvData', [LoginController::class, 'saveEnvData']);
Route::post('saveAdminData', [LoginController::class, 'saveAdminData']);
Route::any('installer', [LoginController::class, 'license']);
Route::get('/login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::group(['middleware' => ['XssSanitizer']], function () {

    Route::get('/admin/login', 'Auth\LoginController@admin');
    Route::post('/admin/login/verify', 'Auth\LoginController@login_verify');
    Route::get('/admin/salon/create', 'admin\SalonController@create');
    Route::post('/admin/salon/store', 'admin\SalonController@store');

    Route::get('/admin/forgetpassword', 'Auth\LoginController@forgetpassword');
    Route::post('/admin/forgetpassword/change', 'Auth\LoginController@adminforgetpassword');

    Route::get('/download-sample', 'admin\LanguageController@downloadSample');

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/logout', 'Auth\LoginController@admin_logout');

        // language
        Route::get('/language/{lang}', 'admin\LanguageController@language');
        Route::post('/language/store', 'admin\LanguageController@store');
        Route::post('/language/hideLanguage', 'admin\LanguageController@hideLanguage');
        Route::post('/language/changeDirection', 'admin\LanguageController@changeDirection');
        Route::get('/language', 'admin\LanguageController@index');

        // Dashboard
        Route::get('/dashboard', 'admin\DashboardController@index');
        Route::get('/adminuserchartdata', 'admin\DashboardController@adminUserChartData');
        Route::get('/adminuserchartmonthdata', 'admin\DashboardController@adminUserMonthChartData');
        Route::get('/adminusercharweekdata', 'admin\DashboardController@adminUserWeekChartData');
        Route::get('/adminrevenuechartdata', 'admin\DashboardController@adminRevenueChartData');
        Route::get('/adminrevenuechartmonthdata', 'admin\DashboardController@adminRevenueMonthChartData');
        Route::get('/adminrevenuecharweekdata', 'admin\DashboardController@adminRevenueWeekChartData');

        //profile
        Route::get('/profile', 'admin\SettingController@admin_show');
        Route::post('/profile/update', 'admin\SettingController@admin_update');
        Route::post('/profile/changepassword', 'admin\SettingController@admin_changePassword');


        //categories
        Route::resource('/categories', 'admin\CategoryController');
        Route::get('/categories', 'admin\CategoryController@index');
        Route::post('/categories/create', 'admin\CategoryController@create');
        Route::post('/categories/store', 'admin\CategoryController@store');
        Route::get('/categories/edit/{id}', 'admin\CategoryController@edit');
        Route::post('/categories/update/{id}', 'admin\CategoryController@update');
        Route::post('/categories/hideCategory', 'admin\CategoryController@hideCategory');


        //services
        Route::resource('/services', 'admin\ServiceController');
        Route::get('/services', 'admin\ServiceController@index');
        Route::get('/services/{id}', 'admin\ServiceController@show');
        Route::get('/services/create', 'admin\ServiceController@create');
        Route::post('/services/store', 'admin\ServiceController@store');
        Route::get('/services/edit/{id}', 'admin\ServiceController@edit');
        Route::post('/services/update/{id}', 'admin\ServiceController@update');
        Route::post('/services/hideService', 'admin\ServiceController@hideService');
        Route::get('/services/delete/{id}', 'admin\ServiceController@destroy');


        //Employees
        Route::resource('/employee', 'admin\EmployeeController');
        Route::get('/employee', 'admin\EmployeeController@index');
        Route::get('/employee/{id}', 'admin\EmployeeController@show');
        Route::get('/employee/create', 'admin\EmployeeController@create');
        Route::post('/employee/store', 'admin\EmployeeController@store');
        Route::get('/employee/edit/{id}', 'admin\EmployeeController@edit');
        Route::post('/employee/update/{id}', 'admin\EmployeeController@update');
        Route::post('/employee/hideEmp', 'admin\EmployeeController@hideEmp');
        Route::get('/employee/delete/{id}', 'admin\EmployeeController@destroy');


        //gallery
        Route::resource('/gallery', 'admin\GalleryController');
        Route::get('/gallery', 'admin\GalleryController@index');
        Route::get('/gallery/{id}', 'admin\GalleryController@show');
        Route::get('/gallery/create', 'admin\GalleryController@create');
        Route::post('/gallery/store', 'admin\GalleryController@store');
        Route::get('/gallery/delete/{id}', 'admin\GalleryController@destroy');
        Route::post('/gallery/hideGallery', 'admin\GalleryController@hideGallery');


        // Banner
        Route::resource('/banner', 'admin\BannerController');
        Route::get('/banner', 'admin\BannerController@index');
        Route::get('/banner/{id}', 'admin\BannerController@show');
        Route::post('/banner/create', 'admin\BannerController@create');
        Route::post('/banner/store', 'admin\BannerController@store');
        Route::get('/banner/edit/{id}', 'admin\BannerController@edit');
        Route::post('/banner/update/{id}', 'admin\BannerController@update');
        Route::get('/banner/delete/{id}', 'admin\BannerController@destroy');
        Route::post('/banner/hideBanner', 'admin\BannerController@hideBanner');

        // Offer
        Route::resource('/offer', 'admin\OfferController');
        Route::get('/offer', 'admin\OfferController@index');
        Route::get('/offer/{id}', 'admin\OfferController@show');
        Route::post('/offer/create', 'admin\OfferController@create');
        Route::post('/offer/store', 'admin\OfferController@store');
        Route::get('/offer/edit/{id}', 'admin\OfferController@edit');
        Route::post('/offer/update/{id}', 'admin\OfferController@update');
        Route::get('/offer/delete/{id}', 'admin\OfferController@destroy');
        Route::post('/offer/hideOffer', 'admin\OfferController@hideOffer');

        //Coupon
        Route::resource('/coupon', 'admin\CouponController');
        Route::get('/coupon', 'admin\CouponController@index');
        Route::get('/coupon/{id}', 'admin\CouponController@show');
        Route::post('/coupon/create', 'admin\CouponController@create');
        Route::post('/coupon/store', 'admin\CouponController@store');
        Route::get('/coupon/edit/{id}', 'admin\CouponController@edit');
        Route::post('/coupon/update/{id}', 'admin\CouponController@update');
        Route::get('/coupon/delete/{id}', 'admin\CouponController@destroy');
        Route::post('/coupon/hideCoupon', 'admin\CouponController@hideCoupon');

        // Reports
        Route::get('/report/user', 'admin\ReportController@user');
        Route::post('/report/user', 'admin\ReportController@user');
        Route::get('/report/revenue', 'admin\ReportController@revenue');
        Route::post('/report/revenue', 'admin\ReportController@revenue');

   

        // Notification
        Route::get('/notification/send', 'admin\NotificationController@send');
        Route::post('/notification/store', 'admin\NotificationController@store');

        // Review
        Route::get('/review', 'admin\ReviewController@index');
        Route::get('/review/{id}', 'admin\ReviewController@show');
        Route::get('/review/delete/{id}', 'admin\ReviewController@destroy');

        // setting
        Route::post('/license/update/{id}', 'admin\SettingController@update_license');
        Route::get('/test_mail', [SettingController::class, 'testMail']);
         

        //booking
        Route::resource('/booking', 'admin\BookingController');
        Route::get('/booking', 'admin\BookingController@index');
        Route::get('/booking/{id}', 'admin\BookingController@show');
        Route::get('/booking/invoice/{id}', 'admin\BookingController@invoice');
        Route::get('/booking/invoice/print/{id}', 'admin\BookingController@invoice_print');
        Route::get('/modal/getdata/{id}', 'admin\BookingController@show');
        Route::get('/booking/create', 'admin\BookingController@create');
        Route::post('/booking/store', 'admin\BookingController@store');
        Route::post('/booking/changestatus', 'admin\BookingController@changeStatus');
        Route::post('/booking/changepaymentstatus', 'admin\BookingController@changePaymentStatus');
        Route::post('/booking/paymentcount', 'admin\BookingController@paymentcount');
        Route::post('/booking/timeslot', 'admin\BookingController@timeslot');
        Route::post('/booking/selectemployee', 'admin\BookingController@selectemployee');

        // Calender
        Route::resource('/calendar', 'admin\CalendarController');

        //users admin
        Route::resource('/users', 'admin\UserController');
        Route::get('/users', 'admin\UserController@index');
        Route::post('/users', 'admin\UserController@index');
        Route::get('/users/{id}', 'admin\UserController@show');
        Route::get('/users/create', 'admin\UserController@create');
        Route::post('/users/store', 'admin\UserController@store');
        Route::get('/users/delete/{id}', 'admin\UserController@destroy');
        Route::post('/users/hideUser', 'admin\UserController@hideUser');
        Route::get('/users/invoice/{id}', 'admin\BookingController@invoice');
        Route::get('/users/invoice/print/{id}', 'admin\BookingController@invoice_print');

        //Salon
        Route::get('/salon', 'admin\SalonController@index');
        Route::get('/salon/edit', 'admin\SalonController@edit');
        Route::post('/salon/update/{id}', 'admin\SalonController@update');
        Route::post('/salon/hideSalon', 'admin\SalonController@hideSalon');
        Route::post('/salon/dayoff', 'admin\SalonController@salonDayOff');
    });
});

Route::prefix('admin')->middleware(['auth'])->group(function()
{
     // Notification
     Route::get('/notification/template', 'admin\NotificationController@template');
     Route::get('/notification/template/edit/{id}', 'admin\NotificationController@edit_template');
     Route::post('/notification/template/update/{id}', 'admin\NotificationController@update_template');

    //settings
    Route::get('/settings', 'admin\SettingController@index');
    Route::post('/settings/update/{id}', 'admin\SettingController@update');   

});
