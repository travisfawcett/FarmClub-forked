<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\ArticleController;

// Route::apiResource('stores', 'API\StoreController')->middleware('cors');
// Route::apiResource('articles', 'API\ArticleController')->middleware('cors');

Route::get('/stores/{store}/articles', 'API\StoreController@articles')->name('stores.articles')->middleware('cors');

Route::get('/stores', 'API\StoreController@index')->middleware('cors');
Route::get('/stores/{store}', 'API\StoreController@show')->middleware('cors');
Route::post('/stores', 'API\StoreController@store')->middleware('cors');
Route::put('/stores/{store}', 'API\StoreController@update')->middleware('cors');
Route::delete('/stores/{store}', 'API\StoreController@destroy')->middleware('cors');

Route::get('/articles', 'API\ArticleController@index')->middleware('cors');
Route::get('/articles/{article}', 'API\ArticleController@show')->middleware('cors');
Route::post('/articles', 'API\ArticleController@store')->middleware('cors');
Route::put('/articles/{article}', 'API\ArticleController@update')->middleware('cors');
Route::delete('/articles/{article}', 'API\ArticleController@destroy')->middleware('cors');
