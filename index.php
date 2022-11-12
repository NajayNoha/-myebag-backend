<?php


require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Support/helpers.php';
require_once __DIR__ . '/routes/home.php';
require_once __DIR__ . '/routes/auth.php';
require_once __DIR__ . '/routes/product.php';
require_once __DIR__ . '/routes/upload.php';



app()->run();