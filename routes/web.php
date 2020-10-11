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
		// Route::get('create', 'VaccineController@create');
		// Route::post('store', 'VaccineController@store');
		// Route::get('/edit/{id}', 'VaccineController@edit');
		// Route::post('/update/{id}', 'VaccineController@update');
	});
	// Route::prefix('admin')->group(function(){
	// 	Route::get('/', function(){
	// 		return view('admin.dashboard');
	// 	});
	// 	Route::prefix('vaccine')->group(function(){
	// 		Route::get('', 'VaccineController@allVaccine');
	// 		Route::get('create', 'VaccineController@create');
	// 		Route::post('store', 'VaccineController@store');
	// 		Route::get('/edit/{id}', 'VaccineController@edit');
	// 		Route::post('/update/{id}', 'VaccineController@update');
	// 	});
	// 	Route::prefix('post')->group(function(){
	// 		Route::get('', 'PostController@getPost');
	// 		Route::get('create', 'PostController@create');
	// 		Route::post('store', 'PostController@store');
	// 		Route::get('/edit/{id}', 'PostController@edit');
	// 		Route::post('/update/{id}', 'PostController@update');
	// 		Route::delete('/delete/{id}', 'PostController@delete');
	// 	});
	// 	Route::prefix('order')->group(function(){
	// 		Route::get('', 'OrderController@getOrder');
	// 		Route::get('/change/{id}', 'OrderController@changeState');
	// 		Route::post('/change/update/{id}', 'OrderController@updateState');
	// 		Route::get('create', 'OrderController@create');
	// 		Route::post('store', 'OrderController@store');
	// 		Route::get('/edit/{id}', 'OrderController@edit');
	// 		Route::post('/update/{id}', 'OrderController@update');
	// 	});
	// 	Route::prefix('user')->group(function(){
	// 		Route::get('', 'UserController@getUser');
	// 		Route::get('/change/{id}', 'UserController@changeRole');
	// 		Route::post('/change/update/{id}', 'UserController@updateRole');
	// 		Route::get('create', 'UserController@create');
	// 		Route::post('store', 'UserController@store');
	// 		Route::get('/edit/{id}', 'UserController@edit');
	// 		Route::post('/update/{id}', 'UserController@update');
	// 		Route::delete('/delete/{id}', 'UserController@delete');
	// 	});
	// });
});
