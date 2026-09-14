<?php

use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


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

Route::get('/drinks', [ProductController::class, 'index']);
Route::get('/drinks/{id}', [ProductController::class, 'show']);
Route::put('/drinks/{id}', [ProductController::class, 'update']);
Route::delete('/drinks/{id}', [ProductController::class, 'destroy']);

Route::prefix('/category')->group(function(){
    Route::get('/',[CategoryController::class, 'index']);
    Route::post('/',[CategoryController::class, 'create']);
});
Route::prefix('/book')->group(function(){
    Route::get('/', [BookController::class, 'index']);
    Route::post('/', [BookController::class, 'create']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::put('/{id}', [BookController::class, 'update']);
    Route::delete('/{id}', [BookController::class, 'delete']);
});
