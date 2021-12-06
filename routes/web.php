<?php

use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->namespace('User')
    ->prefix('user')
    ->name('user.')
    ->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('apartments', ApartmentController::class);
        // Route::resource('users', UserController::class);
});

Route::get('{any?}', function(){
    return view('404');
})->where('any', '.*');
