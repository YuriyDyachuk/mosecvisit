<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Twilio\SendCodeController;
use App\Http\Controllers\API\User\QrCodeController;
use App\Http\Controllers\API\User\MainController;
use App\Http\Controllers\API\User\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {

    /* Basic register && login user */
        Route::post('register', [RegisterController::class, 'register']);
        Route::post('login', [LoginController::class, 'login']);
    /* End section */

    /* Twilio send code in phone user */
        Route::post('send-code', [SendCodeController::class, 'store']);
        Route::patch('verify-code', [SendCodeController::class, 'update']);
    /* End section */

    Route::middleware('auth:sanctum')->group(function () {

        /* User */
        Route::resource('users',MainController::class);

        Route::prefix('user')->group(function () {
            Route::prefix('{user}')->group(function () {
                Route::get('qr-code',[QrCodeController::class, 'index']);
                Route::post('logout', [LogoutController::class, 'logout']);
            });
        });

    });

});
