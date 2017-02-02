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

Route::get('products/details/{id}','ProductController@detailProduct');

Route::group(['prefix' => 'api'], function () {

    Route::get('products', 'ProductController@getProductList');
    Route::post('products/add', 'ProductController@addProduct');
    Route::put('products/update/{id}','ProductController@updateProduct');
    Route::delete('products/delete/{id}','ProductController@deleteProduct');
    Route::get('products/list','ProductController@getProductList');
    Route::get('products/details/{id}','ProductController@detailProduct');
});
