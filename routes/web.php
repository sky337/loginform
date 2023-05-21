<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('/loginform', function () {
    return view('loginform');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard',[AuthController::class, 'dashboard'])->name('dashboard');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/signup', [AuthController::class, 'register'])->name('signup');

Route::post('/send-otp', [AuthController::class, 'generateOTP']);


Route::post('loginform', [UserController::class, 'authenticate'])->name('loginform');

// Route::post('login', [UserController::class,'authethicate']);