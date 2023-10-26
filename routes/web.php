<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::get('/register', function () {
    return view('user.register');
})->name('register');

Route::get('/user', function () {
    return view('user.profile');
})->name('profile');

Route::get('/forgot_password', function () {
    return view('user.forgot_password');
});

Route::get('/reset_password/{token}', function ($token) {
    return view('user.reset_password', ['token' => $token]);
});


