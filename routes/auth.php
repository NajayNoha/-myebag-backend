<?php

use Src\Http\Route;
use App\Controllers\LoginController;
use App\Controllers\SignupController;


Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/auth/check', [LoginController::class, 'is_admin']);

Route::post('/auth/email', [LoginController::class, 'check_email']);


Route::post('/auth/signup', [SignupController::class, 'signup']);