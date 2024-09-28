<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return 'Hail Hydra! - Test Route';
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('tasks/{taskId}/comments', [CommentController::class, 'index']);
    Route::post('tasks/{taskId}/comments', [CommentController::class, 'store']);
    Route::patch('comments/{commentId}', [CommentController::class, 'update']);
    Route::delete('comments/{commentId}', [CommentController::class, 'destroy']);
});