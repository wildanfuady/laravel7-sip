<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/dashboard', 'DashboardController@index');

Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories/store', 'CategoryController@store')->name('categories.store');
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('categories/{id}/show', 'CategoryController@show')->name('categories.show');
Route::get('categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
// method untuk update yaitu put
Route::put('/categories/{id}', 'CategoryController@update')->name('categories.update');
// method untuk delete adalah delete
Route::delete('/categories/{id}', 'CategoryController@destroy')->name('categories.delete');

Route::resource('product', 'ProductController');

Route::get('transaction/index', 'TransactionController@index')->name('transaction.index');
Route::get('transaction/create', 'TransactionController@create')->name('transaction.create');
Route::post('transaction/store', 'TransactionController@store')->name('transaction.store');