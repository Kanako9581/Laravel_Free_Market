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

Auth::routes();
Route::resource('users', 'UserController');
Route::get('/users/{user}/edit_image', 'UserController@editImage')->name('users.edit_image');
Route::patch('/users/{user}/edit_image', 'UserController@updateImage')->name('users.update_image');
Route::get('/users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');
Route::resource('items', 'ItemController');
Route::get('/', 'ItemController@index')->name('top');
Route::patch('/items/{item}/edit_image', 'ItemController@updateImage')->name('items.update_image');
Route::get('/items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');
Route::get('/items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');
Route::get('/items/{item}/finish', 'ItemController@finish')->name('items.finish');
Route::post('/items/purchase', 'ItemController@purchase')->name('items.purchase');
Route::get('/likes', 'LikeController@index')->name('likes.index');
Route::patch('/items/{item}/toggle_like', 'ItemController@toggle_like')->name('items.toggle_like');