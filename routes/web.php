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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'], function(){
	Route::prefix('user')->group(function(){
		Route::get('/', 'UserController@list');
		Route::post('role', 'UserController@role');
	});
	Route::prefix('class')->group(function(){
		Route::get('/', 'ClassController@list');
		Route::get('/create', 'ClassController@create');
		Route::post('/save', 'ClassController@save')->name('save');
		Route::post('delete', 'ClassController@delete')->name('class.delete');
	});
});
