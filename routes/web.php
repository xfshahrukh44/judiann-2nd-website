<?php

use App\Http\Controllers\Admin\SettingController;
use App\Models\Page;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\StreamController;
use App\Http\Controllers\Customer\StreamController as SC;

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

    //course
    Route::get('order', 'BatchSessionController@index')->name('order');
    Route::get('/order-view/{id}', 'BatchSessionController@show')->name('order-view');

    //customer
    Route::get('customer', 'CustomerController@index')->name('customer');
    Route::match(['get', 'post'], '/customer-edit/{id}', 'CustomerController@edit')->name('admin.edit-customer');
    Route::get('/customer-view/{id}', 'CustomerController@show')->name('customer-view');
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
    Route::match(['get', 'post'], '/paymentgatway', 'PaymentGatewayController@index')->name('paymentgatway');

    //stream
    route::get('/stream/{course_id}', [StreamController::class, 'stream'])->name('admin.stream');
    route::get('/allow-user-screen/{course_id}/{customer_id}', [StreamController::class, 'allowUserScreen'])->name('admin.allowUserScreen');
    route::get('/revert-stream/{course_id}/{customer_id}', [StreamController::class, 'revertStream'])->name('admin.revertStream');
    route::get('/viewer-toggle-back/{course_id}/{customer_id}', [StreamController::class, 'viewerToggleBack'])->name('admin.viewerToggleBack');
    route::post('/stream/stop/{course}', [StreamController::class, 'stop'])->name('admin.stopStream');

    //cms
    Route::match(['get', 'post'], '/cms/about-us', 'CmsController@aboutUs')->name('admin.cms.aboutUs');
    Route::match(['get', 'post'], '/cms/faq', 'CmsController@faq')->name('admin.cms.faq');
    Route::match(['get', 'post'], '/cms/about-judiann', 'CmsController@aboutJudiann')->name('admin.cms.aboutJudiann');
    Route::match(['get', 'post'], '/cms/contact', 'CmsController@contactUs')->name('admin.cms.contactUs');
    Route::match(['get', 'post'], '/cms/portfolio', 'CmsController@portfolio')->name('admin.cms.portfolio');

    //faq section
    Route::get('/faq', 'FaqController@index')->name('admin.faq.index');
    Route::post('/faq/create', 'FaqController@store')->name('admin.faq.create');
    Route::delete('/faq/delete/{id}', 'FaqController@delete')->name('admin.faq.destroy');
    Route::get('/faq/edit/{id}', 'FaqController@edit')->name('admin.faq.edit');
    Route::post('/faq/update/{id}', 'FaqController@update')->name('admin.faq.update');

    //portfolio section
    Route::get('/portfolio', 'PortfolioController@index')->name('admin.portfolio.index');
    Route::post('/portfolio/create', 'PortfolioController@store')->name('admin.portfolio.create');
    Route::get('/portfolio/edit/{id}', 'PortfolioController@edit')->name('admin.portfolio.edit');
    Route::post('/portfolio/update/{id}', 'PortfolioController@update')->name('admin.portfolio.update');
    Route::delete('/portfolio/delete/{id}', 'PortfolioController@delete')->name('admin.portfolio.destroy');
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
    Route::get('batch-session', 'BatchSessionController@index')->name('customer.course_session');
    Route::get('/batch-session-view/{id}', 'BatchSessionController@show')->name('customer.course_session.view');

    //stream
    route::get('/stream/{course_id}/{batch_id}', [SC::class, 'stream'])->name('customer.stream');
    route::get('/raise-hand/{course_id}', [SC::class, 'raiseHand'])->name('customer.raise_hand');
    route::get('/stream/get-publisher-token/{session_id}', function($session_id) {
        session()->put('publisher_token', get_fresh_publisher_opentok_token($session_id));
//        return get_fresh_publisher_opentok_token($session_id);
    })->name('customer.getPublisherToken');
    route::get('/stream/get-subscriber-token/{session_id}', function($session_id) {
        session()->put('subscriber_token', get_fresh_subscriber_opentok_token($session_id));
//        return get_fresh_subscriber_opentok_token($session_id);
    })->name('customer.getSubscriberToken');
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

    //contact us
    Route::post('/contact', 'FrontController@send_front_mail')->name('front.send_front_mail');
    Route::get('/contact', function () {
        $setting = \App\Models\Settings::all();
        $contact = Page::where('name', 'Contact')->first();
        if($contact){
            $data = json_decode($contact->content);
            return view('front.contact', compact('contact', 'data', 'setting'));
        }
        return view('front.contact', compact('setting', 'contact'));
    })->name('front.contact');

//    return view('front.contact');
});

Route::get('/about-judiann', function () {
    $about = Page::where('name', 'About Judiann')->first();
    if($about){
        $data = json_decode($about->content);
        return view('front.about-judiann', compact('data', 'about'));
    }
    return view('front.about-judiann', compact('about'));
})->name('front.about-judiann');

Route::get('/about-us', function () {
    $about = Page::where('name', 'About')->first();
    if($about){
        $data = json_decode($about->content);
        return view('front.about-us', compact('data', 'about'));
    }
    return view('front.about-us', compact('about'));
})->name('front.about-us');

Route::get('/faqs', function () {
    $faqs = \App\Models\Faq::all();
    $faqPage = Page::where('name', 'FAQ')->first();
    if($faqPage){
        $data = json_decode($faqPage->content);
        return view('front.faqs', compact('data', 'faqs', 'faqPage'));
    }
    return view('front.faqs', compact('faqPage', 'faqs'));
})->name('front.faqs');

Route::get('/judiann-portfolio', function () {
    $sort_portfolio = \App\Models\Portfolio::all()->sortBy('image_order');
    $portfolio = Page::where('name', 'Portfolio')->first();
    if($portfolio){
        $data = json_decode($portfolio->content);
        return view('front.judiann-portfolio', compact('data', 'portfolio', 'sort_portfolio'));
    }
    return view('front.judiann-portfolio', compact('portfolio', 'sort_portfolio'));
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

Route::get('/video-chatting', function () {
    return view('front.videoChatting');
})->name('front.videoChatting');

Route::get('/testimonial', function () {
    return view('front.testimonial');
})->name('front.testimonial');
Auth::routes();

Route::get('/policy', function () {
    return view('front.policy');
})->name('front.policy');
Auth::routes();

Route::get('/terms', function () {
    return view('front.terms');
})->name('front.terms');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/temp', function () {
//    event(new \App\Events\UserJoined(['name' => 'asd']));
//    dd('end');
//    $courses = \App\Models\Course::all();
//    foreach ($courses as $course) {
//        $course->opentok_session_id = get_fresh_opentok_session_id();
//        $course->save();
//    }
});
