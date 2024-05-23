<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbArticleController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/articles','App\Http\Controllers\AbArticleController@SearchAPI');
Route::post('/articles','App\Http\Controllers\AbArticleController@SearchAPI');
