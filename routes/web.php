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

Route::resource('/', 'PageController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/admin/posts', 'PostController')->middleware('auth');
Route::resource('/admin/users', 'UserController')->middleware('can:admin');
Route::resource('/admin/files', 'FileController')->middleware('auth');

