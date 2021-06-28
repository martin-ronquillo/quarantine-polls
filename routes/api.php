<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Models\User;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return User::first($request->user());
});

Route::middleware('auth:sanctum')->group( function () {

    Route::get('user/index', [UserController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('polls/{id}', [PollController::class, 'show']);
    Route::get('polls/all-per-user/{id}', [PollController::class, 'pollsPerUser']);
    Route::post('polls/store', [PollController::class, 'store']);
    
    Route::get('questions/{id}', [QuestionController::class, 'show']);
    Route::post('questions/store', [QuestionController::class, 'store']);

    Route::get('options/{id}', [OptionController::class, 'show']);
    Route::post('options/store', [OptionController::class, 'store']);

    // Route::get('options/{id}', [OptionController::class, 'show']);
    // Route::post('options/store', [OptionController::class, 'store']);
    
});