<?php

use Src\Http\Route;
use App\Controllers\ProductController;


Route::get('/products', [ProductController::class, 'all']);
Route::get('/product', [ProductController::class, 'one']);
Route::get('/search', [ProductController::class, 'search']);
Route::post('/product', [ProductController::class, 'create']);