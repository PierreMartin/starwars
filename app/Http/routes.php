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



//////////////////////// COTER PUBLIC : ////////////////////////
Route::get('/', 'FrontController@index');
Route::get('product/{id}', 'FrontController@show');

Route::get('terms', 'FrontController@showTerms');

Route::get('contact', 'FrontController@showContact');
Route::post('contact', 'FrontController@sendContact');

Route::get('/categorie/{id}', 'FrontController@showProductByCategory');
Route::get('/tag/{id}', 'FrontController@showProductByTag');
