<?php

use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
})->name("home");


Route::get('/apartments/{id}', 'ApartmentController@show');

// Route per la store di un email che può essere effettuata da tutti e 3 i tipi di utente.
Route::resource('/email', EmailController::class)->only(['create','store']);

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

    Route::get('{any?}', function(){
        return view('404');
    })->where('any', '.*');