<?php

use App\Http\Controllers\api\v1\admin\AdminSimulatorController;
use App\Http\Controllers\api\v1\SimulatorController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/simulators-all', [SimulatorController::class, 'index']);
    //Route::get('/simulators-all', [SimulatorController::class, 'index']);

    Route::prefix('v1')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::apiResource('simulators', AdminSimulatorController::class);
        });
    });
});
