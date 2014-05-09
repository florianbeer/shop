<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['uses' => 'StoreController@getIndex', 'as' => 'home']);
Route::post('order/create', ['uses' => 'StoreController@postCreateorder']);
Route::get('order/history', ['uses' => 'UsersController@getOrderHistory']);
Route::get('order/{id}', ['uses' => 'UsersController@getOrder']);
Route::get('/users/profile', ['uses' => 'UsersController@getProfile']);
Route::get('contact', ['uses' => 'StoreController@getContact']);
Route::controller('store', 'StoreController');
Route::controller('users', 'UsersController');

/* Admin routes */
Route::group(array('before' => 'admin'), function() {
  Route::get('admin', ['uses' => 'AdminController@index']);
  Route::get('admin/users', ['uses' => 'UsersController@getIndex']);
  Route::get('admin/products/{filter}', ['uses' => 'ProductsController@getIndex']);
  Route::get('admin/product/togglefeatured/{id}', ['uses' => 'ProductsController@getToggleFeatured']);
  Route::get('admin/order/process/{id}', ['uses' => 'StoreController@getToggleProcessed']);
  Route::get('admin/order/reopen/{id}', ['uses' => 'StoreController@getToggleProcessed']);
  Route::controller('admin/categories', 'CategoriesController');
  Route::controller('admin/products', 'ProductsController');
});