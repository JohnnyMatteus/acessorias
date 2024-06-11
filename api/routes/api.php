<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot');
    Route::post('/validToken', [AuthController::class, 'validToken']);
    Route::post('/registerNewPassword', [AuthController::class, 'registerNewPassword']);
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'v1', 'name' => 'v1.'], function () {
    Route::apiResource('products', 'Api\ProductController');
    Route::apiResource('orders', 'Api\OrderController');
    Route::apiResource('users', 'Api\UserController');
    Route::post('/logout', 'Api\AuthController@logOut');
});
