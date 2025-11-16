<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DriverHomeController;
use App\Http\Controllers\PassangerHomeController;
use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/request_race', [RaceController::class, 'requestRace'])->name('request_race');
    Route::get('/driver/races', [DriverHomeController::class, 'recentRaces'])->name('recent_races');
    Route::get('/races', [PassangerHomeController::class, 'listRaces'])->name('list_races');
    Route::post('/create-race', [RaceController::class, 'create'])->name('create_race');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register.form');