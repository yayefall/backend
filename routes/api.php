<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\{
    DriverController,
    VehiculeController,
    LavageController,
    EntretienController,
    HistoryController,
    RegisterController
};

// 🔓 Routes publiques
// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔒 Routes protégées
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
 // ➕ Route d'export
    Route::get('/history/exportAll', [HistoryController::class, 'exportAll']);
    Route::apiResource('register', RegisterController::class);
    Route::apiResource('drivers', DriverController::class);
    Route::apiResource('vehicules', VehiculeController::class);
    Route::apiResource('lavages', LavageController::class);
    Route::apiResource('entretiens', EntretienController::class);
    Route::apiResource('history', HistoryController::class);
});
