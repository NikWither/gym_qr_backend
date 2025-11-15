<?php

use App\Http\Controllers\api\v1\admin\AdminSimulatorController;
use App\Http\Controllers\api\v1\SimulatorController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// auth
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::prefix('v1')->group(function () {

    // public routes (not auth)
    Route::get('/simulators', [SimulatorController::class, 'index']);
    Route::get('/simulators/{simulator}', [SimulatorController::class, 'show']);

    // admin
    Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
        Route::apiResource('simulators', AdminSimulatorController::class);
    });
});
