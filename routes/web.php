<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{HomeController, CustomerController, ProfileController, CategoryController};



// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
// Frontend Controllers start

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('index');
Route::get('/about', [App\Http\Controllers\FrontendController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'contact'])->name('contact');
Route::get('/account', [App\Http\Controllers\FrontendController::class, 'account'])->name('account');

// Frontend Controllers end


// Customer Controller start
Route::post('/customerregistration', [App\Http\Controllers\CustomerController::class, 'customerregistration'])->name('customerregistration');
Route::post('/customerlogin', [App\Http\Controllers\CustomerController::class, 'customerlogin'])->name('customerlogin');
Route::post('/customerdashboard', [App\Http\Controllers\CustomerController::class, 'customerdashboard'])->name('customerdashboard');
// Customer Controller end

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

// Profile Routes start

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/photo/upload', [App\Http\Controllers\ProfileController::class, 'profile_photo_upload']);
Route::post('/profile/cover/upload', [App\Http\Controllers\ProfileController::class, 'cover_photo_upload']);
Route::post('/password/change', [App\Http\Controllers\ProfileController::class, 'password_change']);
Route::post('/phone/number/add', [App\Http\Controllers\ProfileController::class, 'phone_number_add']);
Route::post('/code/confirm', [App\Http\Controllers\ProfileController::class, 'code_confirm']);
Route::get('/resend/code', [App\Http\Controllers\ProfileController::class, 'resend_code']);
Route::get('/phone/number/verify', [App\Http\Controllers\ProfileController::class, 'phone_number_verify']);

// Profile Routes end

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


// Category Routes start
Route::resource('/category', CategoryController::class);

// Category Routes end
