<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//below line added
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserController::class)->group(function() {
    Route::post('login', 'loginUser');
    Route::post('register', 'registerUser');
});

Route::post('send_reset_password_email', [PasswordResetController::class, 'send_reset_password_email']);
Route::post('reset_password', [PasswordResetController::class, 'reset_password']);

Route::controller(UserController::class)->group(function() {
    Route::get('user', 'userDetails');
    Route::get('logout', 'userLogout');
})->middleware('auth:api');
