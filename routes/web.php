<?php

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

Route::get('/', function () {
    return redirect()->action('BooksController@index');
})->name('index');
//join_cart.vue
Route::post('/add','BooksController@addToCart');
Route::post('/bought','BooksController@bought');

Route::get('shopcart','BooksController@shopCart')->name('shopcart');
//shop_item.vue
Route::post('getCart','BooksController@getCart');

//checout
Route::get('checkout','BooksController@checkout')->name('checkout');
Route::post('checkout','OrdersController@checkout');
Route::post('callback','OrdersController@callback');
Route::get('redirect','OrdersController@redirect');

Route::resource('books','BooksController');

//admin
Route::get('admin/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout')->name('logout');
Route::get('/orders','OrdersController@index');
Route::delete('orders/{order}','OrdersController@destroy')->name('order.delete');

