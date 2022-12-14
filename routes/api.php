<?php

use App\Http\Controllers\ApiController;
use App\Jobs\SendEmailJob;
use App\Mail\UserMail;
use App\Models\PersonalAccessTokens;
use App\Models\User;
use App\Repository\PersonalAccessTokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('v1')->group(function () {

    // Authorization: Bearer 2|OF86oUIUEjCDZxPPPeiES6FQJxOuCZ85boB9muZc
    Route::middleware('auth:sanctum')->get('/me', function () {
        return auth()->user();
    });

    Route::middleware('auth:sanctum')->post('/send-message', [ApiController::class, 'sendMessage']);

    Route::prefix('user')->middleware('guest')->group(function () {
        Route::any('login', [ApiController::class, 'login']);
        Route::any('register', [ApiController::class, 'register']);
    });
});
