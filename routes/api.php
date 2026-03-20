<?php

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

// Public routes
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::prefix('v1/iroda')->group(function () {
    Route::post('/login', [App\Http\Controllers\Api\Iroda\AuthController::class, 'login']);
});

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Iroda user routes (require iroda or admin privileges)
    Route::middleware('iroda-api')->prefix('v1/iroda')->group(function () {
        // Authentication routes
        Route::post('/logout', [App\Http\Controllers\Api\Iroda\AuthController::class, 'logout']);
        Route::get('/me', [App\Http\Controllers\Api\Iroda\AuthController::class, 'me']);
        
        // Destinations management
        Route::get('/destinations', [App\Http\Controllers\Api\Iroda\DestinationController::class, 'index']);
        Route::post('/destinations', [App\Http\Controllers\Api\Iroda\DestinationController::class, 'store']);
        Route::get('/destinations/{id}', [App\Http\Controllers\Api\Iroda\DestinationController::class, 'show']);
        Route::put('/destinations/{id}', [App\Http\Controllers\Api\Iroda\DestinationController::class, 'update']);
        Route::delete('/destinations/{id}', [App\Http\Controllers\Api\Iroda\DestinationController::class, 'destroy']);
        
        // Reservations management
        Route::get('/reservations', [App\Http\Controllers\Api\Iroda\ReservationController::class, 'index']);
        Route::get('/reservations/{id}', [App\Http\Controllers\Api\Iroda\ReservationController::class, 'show']);
        Route::put('/reservations/{id}/update-details', [App\Http\Controllers\Api\Iroda\ReservationController::class, 'updateReservationDetails']);
        Route::put('/reservations/{id}/details', [App\Http\Controllers\Api\Iroda\ReservationController::class, 'updateDetails']);
        Route::put('/reservations/{id}/update-status', [App\Http\Controllers\Api\Iroda\ReservationController::class, 'updateStatus']);
        Route::post('/reservations/{id}/send-email', [App\Http\Controllers\Api\Iroda\ReservationController::class, 'sendEmail']);
        Route::delete('/reservations/{id}', [App\Http\Controllers\Api\Iroda\ReservationController::class, 'destroy']);
    });
});
