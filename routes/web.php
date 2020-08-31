<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/product/form', 'ProductController@create');
Route::post('/product/save', 'ProductController@insert');

Route::get('/product', 'ProductController@index')->middleware('auth');

Route::get('/product/read/{id}', 'ProductController@read')->middleware('auth');

Route::post('/product/update/{id}', 'ProductController@update')->middleware('auth');
Route::get('/product/delete/{id}', 'ProductController@delete')->middleware('auth');


Route::get('/pdf', 'ProductController@pdf');


// Route::get('/product', 'ProductController@read');
// Route::post('/product', 'ProductController@insert');
// Route::delete('/product', 'ProductController@remove');
