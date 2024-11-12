<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
});
Route::post('logout', [AuthController::class, 'logout']);
Route::get('/courses', [CourseController::class, 'index']);
Route::post('/favorite', [FavoriteController::class, 'store']);
Route::get('/favorite/{id}', [FavoriteController::class, 'getByUserId']);
Route::get('/favorites', [CourseController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
