<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\MemberController;
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

Route::group(['prefix' => 'book'], function () {
    Route::get('/showall', [BookController::class, 'index']);
    Route::post('/store', [BookController::class, 'store']);
    Route::get('/search', [BookController::class, 'search']);
});

Route::group(['prefix' => 'member'], function () {
    Route::get('/showall', [MemberController::class, 'index']);
    Route::post('/store', [MemberController::class, 'store']);
    Route::post('/update/{member}', [MemberController::class, 'update']);
    Route::delete('/destroy/{member}', [MemberController::class, 'destroy']);
    Route::get('/search', [MemberController::class, 'search']);
});

Route::group(['prefix' => 'bookloan'], function () {
    Route::get('/showall', [BookLoanController::class, 'index']);
    Route::post('/store', [BookLoanController::class, 'store']);
    Route::post('/return/{bookLoan}', [BookLoanController::class, 'update']);
});