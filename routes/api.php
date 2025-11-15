<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DriverHomeController;
use App\Http\Controllers\PassangerHomeController;
use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/request_race', [RaceController::class, 'requestRace']);
    Route::get('/driver/races', [DriverHomeController::class, 'recentRaces']);
    Route::get('/races', [PassangerHomeController::class, 'listRaces']);
    Route::post('/create-race', [RaceController::class, 'create']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);