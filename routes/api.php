<?php

use App\Http\Controllers\ApiController;
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
    Route::middleware('auth:sanctum')->get('/me', function () {
        return auth()->user();
    });

    Route::middleware('auth:sanctum')->post('/send-message', [ApiController::class, 'sendMessage']);

    Route::prefix('user')->middleware('guest')->group(function () {
        Route::post('login', [ApiController::class, 'login']);
        Route::post('register', [ApiController::class, 'register']);
    });
});
