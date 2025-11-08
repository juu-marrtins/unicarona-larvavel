<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DriverHomeController;
use App\Http\Controllers\PassangerHomeController;
use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/driver/races', [DriverHomeController::class, 'recentRaces'])->name('home.driver.races');
    Route::get('/races', [PassangerHomeController::class, 'listRaces'])->name('home.passanger.races');
    Route::post('/create-race', [RaceController::class, 'create'])->name('crate.race');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/', function () {
    return view('welcome');
});
