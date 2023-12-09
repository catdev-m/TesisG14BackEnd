<?php

use Illuminate\Support\Facades\Route;
use Memories\Auth\Application\Controllers\AuthController;

Route::post('/login',[AuthController::class,'login']);
Route::post('/menusAndPemisions',[AuthController::class,'menusAndPemisions']);
