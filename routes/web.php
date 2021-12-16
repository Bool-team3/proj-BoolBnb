<?php

use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
})->name("home");


Route::get('/apartments/{id}', 'ApartmentController@show');


Route::get('{any?}', function(){
    return view('404');
})->where('any', '.*');

Auth::routes();

Route::middleware('auth')
    ->namespace('User')
    ->prefix('user')
    ->name('user.')
    ->group(function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('apartments', ApartmentController::class);
        // Route::resource('users', UserController::class);
        
        Route::resource('emails', EmailController::class)->only([
            'index', 'show', 'destroy'
        ]);

        Route::resource('sponsors', SponsorController::class)->only([
            'index', 'store', 'show'
        ]);
    });

