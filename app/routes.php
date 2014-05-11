<?php
/*
 * Shop and static pages
 */
Route::get('/', ['uses' => 'ShopController@index', 'as' => 'home']);
Route::get('contact', ['uses' => 'ShopController@contact', 'as' => 'contact']);
Route::get('sitemap.xml', 'ShopController@sitemap');

/*
 * Product resource
 */
Route::model('products', 'Product');
Route::resource('products', 'ProductsController', ['only' => ['index', 'store', 'show', 'edit', 'update']]);
Route::get('products/{products}/delete', ['uses' => 'ProductsController@destroy', 'as' => 'products.destroy']);
Route::get('products/{products}/toggleFeatured', ['uses' => 'ProductsController@toggleFeatured', 'as' => 'products.togglefeatured']);
Route::get('products/{products}/toggleAvailability', ['uses' => 'ProductsController@toggleAvailability', 'as' => 'products.toggleavailability']);

/*
 * Category resource
 */
Route::model('categories', 'Category');
Route::resource('categories', 'CategoriesController', ['only' => ['index', 'store', 'show', 'edit', 'update']]);
Route::get('categories/{categories}/delete', ['uses' => 'CategoriesController@destroy', 'as' => 'categories.destroy']);
Route::post('categories/{categories}/moveProducts', ['uses' => 'CategoriesController@moveProducts','as' => 'categories.move']);

/*
 * Cart resource
 */
Route::resource('cart', 'CartController' , ['only' => ['index', 'store']]);
Route::get('cart/remove/{identifier}', ['uses' => 'CartController@destroy', 'as' => 'cart.destroy']);
Route::get('cart/{identifier}/qtyUp', ['uses' => 'CartController@qtyUp', 'as' => 'cart.qtyup']);
Route::get('cart/{identifier}/qtyDown', ['uses' => 'CartController@qtyDown', 'as' => 'cart.qtydown']);

/*
 * Order resource
 */
Route::model('orders', 'Order');
Route::resource('orders', 'OrdersController', ['only' => ['index', 'store', 'show']]);
Route::get('orders/{orders}/toggleProcessed', ['uses' => 'OrdersController@toggleProcessed', 'as' => 'orders.toggleprocessed']);

/*
 * User resource
 */
Route::model('users', 'User');
Route::resource('users', 'UsersController', ['only' => ['index', 'store', 'update']]);
Route::get('login', ['uses' => 'UsersController@login', 'as' => 'users.login']);
Route::post('login', ['uses' => 'UsersController@doLogin', 'as' => 'users.login']);
Route::get('logout', ['uses' => 'UsersController@logout', 'as' => 'users.logout']);
Route::get('register', ['uses' => 'UsersController@create', 'as' => 'users.create']);
Route::get('profile', ['uses' => 'UsersController@edit', 'as' => 'users.edit']);

/*
 * Admin
 */
Route::get('/admin', ['uses'  => 'AdminController@index', 'as'    => 'admin.index']);

/*
 * Password reminder
 */
Route::controller('password', 'RemindersController');
