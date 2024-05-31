<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbArticleController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/articles','App\Http\Controllers\AbArticleController@SearchAPI');
Route::post('/api/articles','App\Http\Controllers\AbArticleController@addArticleAPI');
Route::post('/shoppingcart', 'App\Http\Controllers\AbArticleController@addtocart');
Route::get('/shoppingcart', 'App\Http\Controllers\AbArticleController@getcart');
Route::delete('/shoppingcart/{shoppingcartid}/articles/{articleId}','App\Http\Controllers\AbArticleController@deleteCartedArticle');
