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
Route::get('/',                 'FrontController@index');
Route::get('product/{id}',      'FrontController@show');

Route::get('terms',             'FrontController@showTerms');

Route::get('contact',           'FrontController@showContact');
Route::post('contact',          'FrontController@sendContact');

Route::get('/categorie/{id}',   'FrontController@showProductByCategory');
Route::get('/tag/{id}',         'FrontController@showProductByTag');

//////////////////////// COTER PUBLIC : PANIER ////////////////////////
Route::get('/bag',                  'BagController@bagShow');               // view page panier
Route::get('/bag-confirm',          'BagController@bagConfirm');            // view page panier validation
Route::post('/bag-add',             'BagController@bagAddBySession')->name('bag-add');
Route::get('/product-delete/{key}', 'BagController@productDelete')->name('product-delete');     // delete 1 Item From The Session
Route::get('/bag-delete',           'BagController@bagDelete')->name('bag-delete');             // delete all The Session
Route::post('/bag-store',           'BagController@bagStore')->name('bag-store');               // save in db

//////////////////////// COTER BACK : ////////////////////////
Route::group(['prefix' => 'admin'], function () {
    Route::resource('/products', 'Admin\ProductController');        // page d'accueil apres la connection
    Route::get('/orders',        'Admin\OrderController@index');    // page d'affichage des commandes
    Route::get('/unpaid',        'Admin\OrderController@unpaid');   // page d'affichage des commandes non payés
});

//////////////////////////// GESTION D'AUTH : ////////////////////////////
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//////////////////////////// MAIL DEV : ////////////////////////////
Route::get('mail', function() {
    Mail::send('emails.email', ['name' => 'Pierre'], function($message) {
        $message->from('hicode@hicode.fr', 'Laravel');
        $message->to('pierremartin.pro@gmail.com')->cc('bar@exemple.com');
    });
});
