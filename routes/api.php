<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('users', 'index')->middleware('auth:api');;
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');
    Route::get('profile', 'profile')->middleware('auth:api');
    Route::put('profile', 'update')->middleware('auth:api');
});

Route::controller(DocumentController::class)->group(function () {
    Route::get('documents', 'index');
    Route::post('documents', 'store')->middleware('auth:api');
    Route::get('documents/{id}', 'show');
    Route::put('documents/{id}', 'update')->middleware('auth:api');
    Route::delete('documents/{id}', 'destroy')->middleware('auth:api');
});


Route::controller(CommentController::class)->group(function () {
    Route::get('comments', 'index');
    Route::post('comments/user/{id}', 'userStore')->middleware('auth:api');
    Route::post('comments/document/{id}', 'documentStore')->middleware('auth:api');
    Route::get('comments/{id}', 'show');
    Route::put('comments/{id}', 'update')->middleware(['auth:api', 'commented']);
    Route::delete('comments/{id}', 'destroy')->middleware(['auth:api', 'commented']);
});
