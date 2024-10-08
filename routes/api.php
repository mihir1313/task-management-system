<?php

use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('tasks/statistics', [TaskController::class, 'statistics']);
    Route::post('user/insert', [UserController::class, 'insert']);
    Route::get('user/edit/{todo}', [UserController::class, 'edit']);
    Route::put('user/update/{userId}', [UserController::class, 'update']);
    Route::delete('user/delete/{userId}', [UserController::class, 'delete']);

    Route::post('task/insert', [TaskController::class, 'insert']);
    Route::put('task/update/{userId}', [TaskController::class, 'update']);
    Route::get('task/edit/{userId}', [TaskController::class, 'edit']);
    Route::delete('task/delete/{userId}', [TaskController::class, 'delete']);
});
