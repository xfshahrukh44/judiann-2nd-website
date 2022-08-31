<?php

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

    //setting
    Route::match(['get', 'post'], '/settings', 'SettingController@index')->name('settings');
//    Route::match(['get', 'post'], '/paymentgatway', 'PaymentGatewayController@index')->name('paymentgatway');
//    Route::match(['get', 'post'], '/emailsetting', 'EmailSettingController@index')->name('emailsetting');
//
//    //PRODUCT
//    Route::get('/getSubCategories', 'ProductController@getSubCategories')->name('getSubCategories');
//    Route::get('/getOptionValues', 'ProductController@getOptionValues')->name('getOptionValues');
//    Route::get('/checkProductSku', 'ProductController@checkProductSku')->name('checkProductSku');
//    Route::get('/checkProductSlug', 'ProductController@checkProductSlug')->name('checkProductSlug');
//    Route::get('product/changeProductStatus/{id}', 'ProductController@changeProductStatus')->name('changeProductStatus');
//    Route::resource('product', 'ProductController');
//
//    //ORDER
//    Route::get('/order', 'OrderController@index')->name('order.index');
//    Route::get('/order/{id}', 'OrderController@show')->name('order.show');
//    Route::delete('/order/{id}', 'OrderController@destroy')->name('order.destroy');
//    Route::get('order/changeOrderStatus/{id}', 'OrderController@changeOrderStatus')->name('order.changeOrderStatus');
//
//    //REVIEW
//    Route::get('/review', 'ReviewController@index')->name('review.index');
//    Route::get('/review/{id}', 'ReviewController@show')->name('review.show');
//    Route::match(['get', 'post'], '/review/edit/{id}', 'ReviewController@edit')->name('review.edit');
//    Route::delete('review/destroy/{id}', 'ReviewController@destroy');
//
//    //Manufacturer
//    Route::get('/manufacturer', 'ManufacturerController@index')->name('manufacturer.index');
//    Route::match(['get', 'post'], '/manufacturer/create', 'ManufacturerController@create')->name('manufacturer.create');
//    Route::get('/manufacturer/{id}', 'ManufacturerController@show')->name('manufacturer.show');
//    Route::match(['get', 'post'], '/manufacturer/edit/{id}', 'ManufacturerController@edit')->name('manufacturer.edit');
//    Route::post('/manufacturer/changeStatus/{id}', 'ManufacturerController@changeStatus')->name('manufacturer.changeStatus');
//    Route::delete('/manufacturer/destroy/{id}', 'ManufacturerController@destroy');
//
//    // Customer
//    Route::resource('customers', 'CustomersController');
//    Route::delete('/customers/destroy/{id}', 'CustomersController@destroy')->name('customers.destroy');
//
//
//    Route::get('/catalog/attribute-groups', 'AttributeGroupController@show')->name('catalog.attributeGroups');
//    Route::match(['get', 'post'], '/catalog/add-attribute-group', 'AttributeGroupController@add')->name('catalog.addAttributeGroup');
//    Route::match(['get', 'post'], '/catalog/edit-attribute-group/{id}', 'AttributeGroupController@edit')->name('catalog.editAttributeGroup');
//    Route::delete('/catalog/destroy-attribute-group/{id}', 'AttributeGroupController@destroy')->name('catalog.destroyAttributeGroup');
//
//    Route::get('/catalog/attributes', 'AttributeController@show')->name('catalog.attributes');
//    Route::match(['get', 'post'], '/catalog/add-attribute', 'AttributeController@add')->name('catalog.addAttributes');
//    Route::match(['get', 'post'], '/catalog/edit-attribute/{id}', 'AttributeController@edit')->name('catalog.editAttribute');
//    Route::delete('/catalog/destroy-attribute/{id}', 'AttributeController@destroy')->name('catalog.destroyAttribute');
//
//    //New Attributes Routes
//    Route::get('/catalog/attribute', 'AttributeController@index')->name('attribute.index');
//    Route::match(['get', 'post'], '/catalog/addAttributeGroup', 'AttributeController@addAttributeGroup')->name('attribute.addAttributeGroup');
//    Route::match(['get', 'post'], '/catalog/addAttributes', 'AttributeController@addAttributes')->name('attribute.addAttributes');
//    Route::match(['get', 'post'], '/catalog/edit-attributes/{type}/{id}', 'AttributeController@editAttributes')->name('attribute.editAttributes');
//    Route::delete('/catalog/destroy-attributes/{type}/{id}', 'AttributeController@destroyAttributes')->name('attribute.destroyAttributes');
//
//    //New Options Routes
//    Route::get('/catalog/option', 'OptionsController@index')->name('option.index');
//    Route::match(['get', 'post'], '/catalog/addOptions', 'OptionsController@addOptions')->name('option.addOptions');
//    Route::match(['get', 'post'], '/catalog/addOptionsValues', 'OptionsController@addOptionsValues')->name('option.addOptionsValues');
//    Route::match(['get', 'post'], '/catalog/edit-options/{type}/{id}', 'OptionsController@editOptions')->name('option.editOptions');
//    Route::delete('/catalog/destroy-options/{type}/{id}', 'OptionsController@destroyOptions')->name('option.destroyOptions');
//
//
//    Route::get('/catalog/options', 'OptionsController@show')->name('catalog.options');
//    Route::match(['get', 'post'], '/catalog/add-option', 'OptionsController@add')->name('catalog.addOption');
//    Route::match(['get', 'post'], '/catalog/edit-option/{id}', 'OptionsController@edit')->name('catalog.editOption');
//    Route::delete('/catalog/destroy-option/{id}', 'OptionsController@destroy')->name('catalog.destroyOption');
//
//    Route::get('/catalog/option-values', 'OptionValuesController@show')->name('catalog.optionValues');
//    Route::match(['get', 'post'], '/catalog/add-option-value', 'OptionValuesController@add')->name('catalog.addOptionValue');
//    Route::match(['get', 'post'], '/catalog/edit-option-value/{id}', 'OptionValuesController@edit')->name('catalog.editOptionValue');
//    Route::delete('/catalog/destroy-option-value/{id}', 'OptionValuesController@destroy')->name('catalog.destroyOptionValue');
//
//    //NewsLetter
//    Route::get('/newsletter', 'NewsLetterController@index')->name('newsletter.index');
//    Route::post('/newsletter/edit/{id}', 'NewsLetterController@edit')->name('newsletter.edit');
//    Route::delete('/newsletter/destroy/{id}', 'NewsLetterController@destroy');
//    //    Route::delete('customers/delete/{id}','CustomersController@destroy');
//
//    //Shipping Rate
//    Route::get('/shipping', 'ShippingRateController@index')->name('shipping.index');
//    Route::match(['get', 'post'], '/shipping/create', 'ShippingRateController@create')->name('shipping.create');
//    Route::get('/shipping/{id}', 'ShippingRateController@show')->name('shipping.show');
//    Route::match(['get', 'post'], '/shipping/edit/{id}', 'ShippingRateController@edit')->name('shipping.edit');
//    Route::post('/shipping/changeStatus/{id}', 'ShippingRateController@changeStatus')->name('shipping.changeStatus');
//    Route::delete('/shipping/destroy/{id}', 'ShippingRateController@destroy');
//
//    //Blogs
//    Route::get('blog/changeBlogStatus/{id}', 'BlogController@changeBlogStatus')->name('changeBlogStatus');
//    Route::resource('blog', 'BlogController');
//
//    Route::get('/discount-codes', 'CouponController@index')->name('coupons.index');
//    Route::match(['get', 'post'], '/discount-code/create', 'CouponController@create')->name('coupons.create');
//    Route::get('/discount-codes/{id}', 'CouponController@show')->name('coupons.show');
//    Route::match(['get', 'post'], '/discount-code/edit/{id}', 'CouponController@edit')->name('coupons.edit');
//    Route::post('/discount-codes/changeStatus/{id}', 'CouponController@changeStatus')->name('coupons.changeStatus');
//    Route::delete('/discount-codes/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');
//
//
//    Route::match(['get', 'post'], '/change-password', 'AdminController@changePassword')->name('admin.changePassword');
//    /* CMS Routes Start */
//    Route::get('cms/page/{slug}', 'CMSController@index')->name('cms.index');
//    Route::post('cms/sort/{id}', 'CMSController@sortSection')->name('cms.sort');
//    Route::match(['get', 'post'], 'cms/update-section/{id}', 'CMSController@updateSection');
//    Route::match(['get', 'post'], 'cms/contact', 'CMSController@contactDetail');
//    /* CMS Routes End */
//
//    // testimonial
//    Route::get('/testimonial/changeBlogStatus/{id}', 'TestimonialController@changeBlogStatus')->name('changeBlogStatus');
//    Route::get('/testimonial', 'TestimonialController@index')->name('testimonial.index');
//    Route::get('/testimonial/create', 'TestimonialController@create')->name('testimonial.create');
//    Route::post('/testimonial/store', 'TestimonialController@store')->name('testimonial.store');
//    Route::get('/testimonial/edit/{id}', 'TestimonialController@edit')->name('testimonial.edit');
//    Route::post('/testimonial/update/{id}', 'TestimonialController@update')->name('testimonial.update');
//    Route::delete('/testimonial/destroy/{id}', 'TestimonialController@destroy')->name('testimonial.destroy');
//
//    Route::get('/agents', 'AgentsController@index')->name('agent.index');
//    Route::match(['get', 'post'], '/agents/create', 'AgentsController@create')->name('agent.create');
//    Route::post('/agents/store', 'AgentsController@store')->name('agent.store');
//    Route::match(['get', 'post'], '/agents/edit/{id}', 'AgentsController@edit')->name('agent.edit');
//    Route::post('/agents/update/{id}', 'AgentsController@update')->name('agent.update');
//    Route::post('/agents/changeStatus/{id}', 'AgentsController@changeStatus')->name('agent.changeStatus');
//    Route::delete('/agents/{id}', 'AgentsController@destroy');
//
//    Route::get('slots', 'SlotsController@index')->name('slots.index');
//    Route::match(['get', 'post'], 'slots/create', 'SlotsController@create')->name('slots.create');
//    Route::match(['get', 'post'], 'slots/edit/{id}', 'SlotsController@edit')->name('slots.edit');
//    Route::delete('slots/destroy/{id}', 'SlotsController@destroy')->name('slots.destroy');
//    Route::post('/slots/changeSlotStatus/{id}', 'SlotsController@changeStatus')->name('slots.changeStatus');
//    Route::get('/slots/getSlots', 'SlotsController@getSlots')->name('slots.getSlots');
//
//    Route::get('/appointments', 'AppointmentController@index')->name('appointments.index');
//    Route::get('/appointments/{id}', 'AppointmentController@show')->name('appointments.show');
//    Route::delete('appointments/destroy/{id}', 'AppointmentController@destroy')->name('appointments.destroy');
});


Route::get('/', function () {
    return view('front.home');
})->name('front.home');

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

Route::get('/schedule', function () {
    return view('front.schedule');
})->name('front.schedule');

Route::get('/services', function () {
    return view('front.services');
})->name('front.services');

Route::get('/students-work', function () {
    return view('front.students-work');
})->name('front.students-work');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
