<?php

use Src\Http\Route;
use App\Controllers\HomeController;

Route::get('/',  [HomeController::class, 'index']);