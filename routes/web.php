<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;

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

//ADMIN LOGIN
Route::get('/admin/login', function () {
    return view('admin.auth.login');
})->name('admin.login')->middleware('guest');

Route::namespace('App\Http\Controllers\Admin')->prefix('/admin')->middleware('admin')->group(function () {
    //Dashboard
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

    //course
    Route::get('course', 'CourseController@index')->name('course');
    Route::match(['get', 'post'], '/add-course', 'CourseController@addCourse')->name('admin.add-course');
    Route::match(['get', 'post'], '/course-edit/{id}', 'CourseController@edit')->name('admin.edit-course');
    Route::get('/course-view/{id}', 'CourseController@show')->name('course-view');
    Route::delete('course/destroy/{id}', 'CourseController@destroy');

    //customer
    Route::get('customer', 'CustomerController@index')->name('customer');
    Route::match(['get', 'post'], '/customer-edit/{id}', 'CustomerController@edit')->name('admin.edit-customer');
    Route::post('/customer/block/{id}', 'CustomerController@block')->name('customer-block');
    Route::delete('customer/delete/{id}', 'CustomerController@destroy');

    //latest_update
    Route::get('latest-update', 'LatestUpdateController@index')->name('latest-update');
    Route::match(['get', 'post'], '/add-latest-update', 'LatestUpdateController@addLatestUpdate')->name('admin.add-latest-update');
    Route::match(['get', 'post'], '/latest-update-edit/{id}', 'LatestUpdateController@edit')->name('admin.edit-latest-update');
    Route::get('/latest-update-view/{id}', 'LatestUpdateController@show')->name('latest-update-view');
    Route::delete('latest-update/destroy/{id}', 'LatestUpdateController@destroy');

    //setting
    Route::match(['get', 'post'], '/settings', 'SettingController@index')->name('settings');
    route::get('/changePassword', [SettingController::class, 'changePassword']);
    route::post('/updateAdminPassword', [SettingController::class, 'updateAdminPassword']);
});

//Customer routes
Route::get('/customer/login', function () {
    return view('customer.auth.login');
})->name('customer.login')->middleware('guest');

Route::namespace('App\Http\Controllers\Customer')->prefix('/customer')->middleware('customer')->group(function () {
    //Dashboard
    Route::get('dashboard', 'CustomerController@dashboard')->name('customer.dashboard');

    //Profile
    route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    route::post('/updateProfile', [CustomerController::class, 'updateProfile'])->name('customer.updateProfile');

    //CourseSession (registered courses)
    Route::get('course-session', 'CourseSessionController@index')->name('customer.course_session');
    Route::get('/course-session-view/{id}', 'CourseSessionController@show')->name('customer.course_session.view');

//    //course
//    Route::get('course', 'CourseController@index')->name('course');
//    Route::match(['get', 'post'], '/add-course', 'CourseController@addCourse')->name('admin.add-course');
//    Route::match(['get', 'post'], '/course-edit/{id}', 'CourseController@edit')->name('admin.edit-course');
//    Route::get('/course-view/{id}', 'CourseController@show')->name('course-view');
//    Route::delete('course/destroy/{id}', 'CourseController@destroy');
//
//    //setting
//    Route::match(['get', 'post'], '/settings', 'SettingController@index')->name('settings');
});


//Front routes
Route::namespace('App\Http\Controllers\Front')->group(function () {

    //home
    Route::get('/', 'FrontController@home')->name('front.home');

    //schedule
    Route::get('/schedule', 'FrontController@schedule')->name('front.schedule');
    Route::post('/schedule-class', 'FrontController@schedule_class')->name('front.schedule_class');

    //payments
    Route::post('/process_payment', 'FrontController@process_payment')->name('front.process_payment');
});

Route::get('/about-judiann', function () {
    return view('front.about-judiann');
})->name('front.about-judiann');

Route::get('/about-us', function () {
    return view('front.about-us');
})->name('front.about-us');

Route::get('/contact', function () {
    return view('front.contact');
})->name('front.contact');

Route::get('/faqs', function () {
    return view('front.faqs');
})->name('front.faqs');

Route::get('/judiann-portfolio', function () {
    return view('front.judiann-portfolio');
})->name('front.judiann-portfolio');

//Route::get('/schedule', function () {
//    return view('front.schedule');
//})->name('front.schedule');

Route::get('/services', function () {
    return view('front.services');
})->name('front.services');

Route::get('/students-work', function () {
    return view('front.students-work');
})->name('front.students-work');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
