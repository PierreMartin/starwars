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

//////////////////////// COTER PUBLIC : ACHAT ////////////////////////
Route::get('/bag', 'FrontController@bag');                  // view page panier
Route::get('/bag-confirm', 'FrontController@bagConfirm');   // view page panier validation
Route::resource('/shop/products', 'ShopController');        // CRUD 'store' (start the session)
Route::get('/bag-delete/{id}', 'FrontController@bagDelete')->name('bag-delete');     // delete 1 Item From The Session



//////////////////////// COTER BACK : ////////////////////////
Route::group(['prefix' => 'admin'], function () {
    Route::resource('/products', 'Admin\ProductController');// page d'accueil apres la connection
});


//////////////////////////// GESTION D'AUTH : ////////////////////////////
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
