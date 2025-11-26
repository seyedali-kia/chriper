<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ImageController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

Route::get('/', [ChirpController::class, 'index']);

Route::middleware('auth')->group(function(){

    Route::post('/chirps',[ChirpController::class, 'store']);
    Route::get('chirps/{chirp}/edit',[ChirpController::class, 'edit']);
    Route::put('/chirps/{chirp}',[ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}',[ChirpController::class, 'destroy']);
    Route::get('/upload-profile',[ImageController::class,'uploadForm'])->name('upload.form');
    Route::post('/upload-profile',[ImageController::class,'upload'])->name('upload');

});




// REGISTER ROUTES
Route::view('/register','auth.register')
    ->Middleware('guest')
    ->name('register');

Route::post('/register', Register::class);

// LOGOUT
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');

// LOGIN
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('login',Login::class)
    ->middleware('guest');