<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'rest'], function () {
    Route::get('articles', 'Rest\ArticleController@getArticles');
    Route::get('articles/', 'Rest\ArticleController@getArticlesByPagination');
    Route::get('article/{id}', 'Rest\ArticleController@showArticle');
    Route::post('filter', 'Rest\ArticleController@articleByFilter');
    Route::post('article/{id}', 'Rest\ArticleController@updateArticle');
    Route::post('article', 'Rest\ArticleController@createArticle');
    Route::delete('article/{id}', 'Rest\ArticleController@deleteArticle');
});

