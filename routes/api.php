<?php

use App\Http\Controllers\Api\V1\AuthTokenController;
use App\Http\Controllers\Api\V1\BebekApiController;
use App\Http\Controllers\Api\V1\LohusaApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::post('/auth/token', [AuthTokenController::class, 'store'])->name('auth.token');

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('lohusa', LohusaApiController::class)->parameters(['lohusa' => 'lohusa']);
        Route::apiResource('bebek', BebekApiController::class)->parameters(['bebek' => 'bebek']);
    });
});
