<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FavoriteController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::post('auth/login', [AuthController::class, 'login']);

// // Protected routes
// Route::middleware('auth:api')->group(function () {
//     Route::get('user', [AuthController::class, 'getUser']);
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::post('/password/change', [ChangePasswordController::class, 'changePassword']);
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::get('/carts', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::put('/cart/{id}', [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
    Route::delete('/cart', [CartController::class, 'clear']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/favorite', [FavoriteController::class, 'store']);
    Route::get('user/favorite', [FavoriteController::class, 'getByUserId']);
    Route::get('/favorites', [CourseController::class, 'index']);
    Route::delete('/user/favorite/{id}', [FavoriteController::class, 'destroy']);
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/courses', [CourseController::class, 'index']);