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
