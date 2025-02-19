<?php

use App\Http\Controllers\AiReviewC;
use App\Http\Controllers\AuthC;
use App\Http\Controllers\QuestionC;
use App\Http\Controllers\ResponseC;
use App\Http\Controllers\ReviewC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->controller(AuthC::class)->group(function () {
    Route::post('/login', 'login');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout');
        Route::get('me', 'me');
    });
});

Route::prefix('/questions')->controller(QuestionC::class)->group(function () {
    Route::get('/', 'list');
    Route::get('/{id}', 'find')->whereNumber('id');
    Route::get('/count', 'count');
    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});

Route::prefix('/responses')->controller(ResponseC::class)->group(function () {
    Route::get('/', 'list');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update')->whereNumber('id');
    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/{id}', 'delete');
    });
});

Route::prefix('/reviews')->controller(ReviewC::class)->group(function () {
    Route::get('/', 'list');
    Route::get('/{id}', 'find');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});

Route::prefix('/ai-reviews')->controller(AiReviewC::class)->group(function () {
    Route::get('/', 'list');
    Route::get('/{id}', 'find');
    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/{id}', 'delete');
    });
});
