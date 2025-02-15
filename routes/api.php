<?php

use App\Http\Controllers\QuestionC;
use App\Http\Controllers\ResponseC;
use App\Http\Controllers\ReviewC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/questions')->controller(QuestionC::class)->group(function () {
    Route::get('/', 'list');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::prefix('/responses')->controller(ResponseC::class)->group(function () {
    Route::get('/', 'list');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::prefix('/reviews')->controller(ReviewC::class)->group(function () {
    Route::get('/', 'list');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});
