<?php

use App\Http\Controllers\Api\PostsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', [PostsController::class, 'index']);
Route::post('posts', [PostsController::class, 'store']);
Route::get('posts/{slug}', [PostsController::class, 'show']);
Route::get('posts/{id}/edit', [PostsController::class, 'edit']);
Route::put('posts/{id}/edit', [PostsController::class, 'update']);
Route::delete('posts/{id}/delete', [PostsController::class, 'destroy']);
