<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Resources\TasksResource;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::prefix("/tasks")->group(function () {
        Route::apiResource('/', TasksController::class);
        Route::post("/", [TasksController::class, 'store']);
        Route::delete("/{task}", [TasksController::class, 'destroy']);
    });
});

Route::post('/login', [AuthController::class, 'login']);
