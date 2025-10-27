<?php

use Illuminate\Support\Facades\Route;

Route::controller('App\Http\Controllers\AuthController')->group(function () {
    Route::get('login', 'login')->name('login')->middleware('guest');
    Route::post('login', 'doLogin')->name('doLogin');
    Route::post('logout', 'logout')->name('logout');
});

Route::get('/', ['App\Http\Controllers\Client\HomeController', 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
    Route::resource('property', 'App\Http\Controllers\Admin\PropertyController');
    Route::resource('option', 'App\Http\Controllers\Admin\OptionController')->except(['show']);
    Route::delete('picture/{picture}', 'App\Http\Controllers\Admin\PictureController@destroy')->name('picture.destroy')->where(['picture' => '[0-9]+']);
});

Route::controller('App\Http\Controllers\Client\PropertyController') ->name('properties.')->group(function () {
    Route::get('properties', 'index')->name('index');
    Route::get('properties/{slug}-{property}', 'show')->name('show')->where(['property' => '[0-9]+', 'slug' => '[-a-zA-Z0-9_]+']);
    Route::post('properties/{property}/contact', 'contact')->name('contact')->where(['property' => '[0-9]+']);
});
