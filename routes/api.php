<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowRecordsController;
use App\Http\Controllers\CategoryController;
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
});
////////////////////////////////////
Route::get('books', [BookController::class, 'index']);
Route::post('create-books', [BookController::class, 'store']);
Route::delete('delet-books/{book}', [BookController::class, 'destroy']);
Route::put('/update-books/{id}', [BookController::class, 'update']);
///////////////////////
Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
   // Route::delete('users/{id}', [UserController::class, 'destroy']);
});
Route::delete('delet-users/{user}', [ UserController::class, 'destroy'])->middleware(['auth:api', 'admin']);


//    Route::get('users/{id}', [UserController::class, 'show']);
//    Route::post('users', [UserController::class, 'store']);
//     Route::put('users/{id}', [UserController::class, 'update']);
    //Route::delete('users/{id}', [UserController::class, 'destroy']);
//teRoute::resource('users', UserController::class);
///////////////////

Route::middleware('auth:api')->group(function () {
    Route::get('borrows', [BorrowRecordsController::class, 'index']);
    Route::get('borrows/{id}', [BorrowRecordsController::class, 'show']);
    Route::post('borrows', [BorrowRecordsController::class, 'store']);
    Route::put('borrows/{id}', [BorrowRecordsController::class, 'update']);
    Route::delete('borrows/{id}', [BorrowRecordsController::class, 'destroy']);
});
    use App\Http\Controllers\RatingController;

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('ratings', RatingController::class);
    });
    Route::middleware('auth:api')->group(function () {
    Route::get('books_filter', [BookController::class, 'filter']);
    });

Route::apiResource('categories', CategoryController::class);
