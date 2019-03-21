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
    return view('welcome');
})->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/result', 'StudentController@getResult')->name('get-result');

Route::group(['namespace' => 'Admin'], function () {
	Route::get('/dashboard', 'AdminController@index')->name('dashboard');

	Route::get('/get-all', 'AdminController@getAll')->name('get-all');

	Route::get('/get-all-student', 'AdminController@getAllStudent')->name('get-all-student');

	Route::post('/add-student', 'AdminController@addStudent')->name('add-student');
});
