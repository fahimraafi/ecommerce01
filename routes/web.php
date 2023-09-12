<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes start

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/photo/upload', [App\Http\Controllers\ProfileController::class, 'profile_photo_upload']);
Route::post('/profile/cover/upload', [App\Http\Controllers\ProfileController::class, 'cover_photo_upload']);
Route::post('/password/change', [App\Http\Controllers\ProfileController::class, 'password_change']);
Route::get('/phone/number/verify', [App\Http\Controllers\ProfileController::class, 'phone_number_verify']);

// Profile Routes end
