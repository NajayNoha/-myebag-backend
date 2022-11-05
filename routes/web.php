<?php
require_once __DIR__.'/../vendor/autoload.php';
// require_once __DIR__.'/../vendor/autoload.php';


use myebag\Http\Route;

use App\controller\UserLoginController;


Route::post('\ ', [ UserLoginController::class , 'home']);

// echo "hello web";
