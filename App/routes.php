<?php

use App\Controllers\HomeController;
use Zeero\Core\Router\Route;

$app = Route::getInstance();

$app->get('/', [HomeController::class, 'Index']);