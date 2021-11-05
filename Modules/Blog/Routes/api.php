<?php


use Modules\Blog\Http\Controllers\Comment\CommentPrivateController;
use Modules\Blog\Http\Controllers\Comment\CommentPublicController;
use Modules\Blog\Http\Controllers\Post\PostPrivateController;
use Modules\Blog\Http\Controllers\Post\PostPublicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->group(function () {
    Route::post('posts', [PostPrivateController::class, 'store']);
    Route::put('posts/{id}', [PostPrivateController::class, 'update']);
    Route::delete('posts/{id}', [PostPrivateController::class, 'destroy']);
    Route::get('me/posts', [PostPrivateController::class, 'index']);

    Route::post('posts/{post_id}/comments', [CommentPrivateController::class, 'store']);
    Route::post('posts/{post_id}/comments/{id}', [CommentPrivateController::class, 'update']);
    Route::delete('posts/{post_id}/comments/{id}', [CommentPrivateController::class, 'destroy']);
    Route::get('me/posts/{post_id}/comments', [CommentPrivateController::class, 'index']);
});

Route::middleware('api')->group(function () {
    Route::get('posts', [PostPublicController::class, 'index']);
    Route::get('posts/{id}', [PostPublicController::class, 'show']);

    Route::get('posts/{post_id}/comments', [CommentPublicController::class, 'index']);
    Route::get('posts/{post_id}/comments/{id}', [CommentPublicController::class, 'show']);
});
