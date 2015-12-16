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


/*
Route::get('products', 'PostController@index');
Route::get('product/{id?}', 'PostController@show');

Route::get('contact', 'PostController@showContact');
Route::post('contact', 'PostController@sendContact');
*/
