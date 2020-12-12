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
Route::post('getQty','BooksController@getQty');
Route::post('get_items','BooksController@get_items');
Route::post('get_sum','BooksController@get_sum');
Route::post('get_itemqty','BooksController@get_itemQty');
Route::post('remove_item','BooksController@removeItem');
Route::post('minus_one','BooksController@minus_one');

//checout
Route::get('checkout','BooksController@checkout')->name('checkout');
Route::post('checkout','OrdersController@checkout');
Route::post('callback','OrdersController@callback');
Route::get('redirect','OrdersController@redirect');

Route::resource('books','BooksController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
