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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return User::first($request->user());
// });

Route::middleware('auth:sanctum')->group( function () {
    
    Route::get('user/is-logged', [UserController::class, 'isLogg']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('polls/{id}', [PollController::class, 'show']);
    Route::get('polls/search/{query}', [PollController::class, 'searchPoll']);
    //Regresa las encuestas en las que el usuario ha participado
    Route::get('polls/user/{id}', [PollController::class, 'pollsPerUser']);
    //regresa las encuestas que el usuario ha creado
    Route::get('user/{id}/polls', [UserController::class, 'pollsUser']);
    Route::post('polls', [PollController::class, 'store']);
    
    Route::get('questions/{id}', [QuestionController::class, 'show']);
    //Regresa las preguntas de una encuesta para responderla
    Route::get('polls/{id}/questions', [PollController::class, 'showPerPoll']);

    Route::apiResource('questions', 'QuestionController')->only('store', 'update');

    Route::apiResource('options', 'OptionController')->only('show', 'store');
});