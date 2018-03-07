<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Content-Type');

// トップページ - ~/
Route::get('/', function() {
    return view('index');
});

// 開発ページ - ~/develop
Route::get('develop', 'DevelopController@get');
Route::get('develop/data', 'DevelopController@getData');

// クライアント向けAPI
Route::post('user/oauth', 'UserController@oauth');
Route::get('user/setting', 'UserController@select');
Route::post('user/setting', 'UserController@update');

Route::get('group/list', 'GroupController@index');
Route::get('group/staff', 'GroupController@staff');

Route::get('article/list', 'ArticleController@index');
Route::get('article/header', 'ArticleController@header');
Route::get('article/info', 'ArticleController@info');
Route::get('article/detail', 'ArticleController@detail');
Route::get('article/filter', 'ArticleController@filter');
Route::post('article/view', 'ArticleController@view');

Route::get('article/favorite', 'FavoriteController@select');
Route::post('article/favorite', 'FavoriteController@insert');

Route::get('article/share', 'ShareController@select');
Route::post('article/share', 'ShareController@insert');
