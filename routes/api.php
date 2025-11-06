<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/create-race', [RaceController::class, 'create']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);