<?php

use App\Http\Controllers\Api\FoodController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is running smoothly',
        'data' => [
            'status' => 'OK',
            'timestamp' => now()->toIso8601String(),
        ],
    ]);
});

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/{id}', [FoodController::class, 'show']);
Route::put('/foods/{id}', [FoodController::class, 'update']);
Route::delete('/foods/{id}', [FoodController::class, 'destroy']);
