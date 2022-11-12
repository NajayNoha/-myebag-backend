<?php

use Src\Http\Route;
use App\Controllers\UploadController;


Route::post('/upload', [UploadController::class, 'save']);