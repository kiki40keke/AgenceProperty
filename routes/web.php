<?php

use Illuminate\Support\Facades\Route;

Route::get('/', ['App\Http\Controllers\HomeController', 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
    Route::resource('property', 'App\Http\Controllers\Admin\PropertyController');
    Route::resource('option', 'App\Http\Controllers\Admin\OptionController')->except(['show']);
});
