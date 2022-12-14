<?php

use Src\Http\Route;
use App\Controllers\ProductController;


Route::get('/products', [ProductController::class, 'all']);
Route::get('/products/featured', [ProductController::class, 'get_featured_products']);
Route::get('/product', [ProductController::class, 'one']);
Route::get('/search', [ProductController::class, 'search']);
Route::post('/product', [ProductController::class, 'create']);
Route::post('/product/update', [ProductController::class, 'update']);