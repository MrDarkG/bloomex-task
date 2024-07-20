<?php

use App\Http\Controllers\Issue\IssueController;
use App\Http\Controllers\Priority\PriorityController;
use App\Http\Controllers\Projects\ProjectController;
use App\Http\Controllers\Statuses\StatusesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'issues'], function () {
        Route::get('/', [IssueController::class, 'index']);
        Route::post('/', [IssueController::class, 'store']);
        Route::put('/', [IssueController::class, 'update']);
        Route::delete('/{id}', [IssueController::class, 'destroy']);
        Route::get('/{id}', [IssueController::class, 'show']);
    });

    Route::group(['prefix' => 'projects'], function () {
        Route::get('/', [ProjectController::class, 'index']);
    });

    Route::group(['prefix' => 'priorities'], function () {
        Route::get('/', [PriorityController::class, 'index']);
    });

    Route::group(['prefix' => 'statuses'], function () {
        Route::get('/', [StatusesController::class, 'index']);
    });
});
