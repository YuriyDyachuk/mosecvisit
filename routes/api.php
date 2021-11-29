<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function (){
    Route::prefix('login')->group(function (){
        Route::post('', [AuthController::class, 'login']);
        Route::post('verify', [AuthController::class, 'loginVerify'])->middleware('auth:sanctum');
    });
    Route::prefix('register')->group(function (){
        Route::post('', [AuthController::class, 'register']);
        Route::post('verify', [AuthController::class, 'registerVerify'])->middleware('auth:sanctum');
    });
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


Route::middleware(['auth:sanctum','verify'])->group(function (){
    Route::get('events', function (){
        dd(1);
    });
});

