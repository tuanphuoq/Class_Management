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
Route::get('/info', function () {
    echo "Admin account username - password : admin@gmail.com - password </br>
	Teacher account username - password : tuan.tt@gmail.com	- password </br>
	Student account username - password : ma@gmail.com	- password";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'], function(){
	Route::get('/download/{path}/{file}', 'ClassController@downloadFile');
	
	Route::prefix('user')->group(function(){
		Route::get('/', 'UserController@list')->name('user');
		Route::post('role', 'UserController@role');
		Route::get('/change-password', 'UserController@changePassword')->name('changepassword');
		Route::post('/save-password', 'UserController@savePassword')->name('savepassword');
	});
	Route::prefix('class')->group(function(){
		Route::get('/', 'ClassController@list')->name('class.list');
		Route::get('/create', 'ClassController@create');
		Route::get('search', 'ClassController@search')->name('class.search');
		Route::post('/save', 'ClassController@save')->name('save');
		Route::post('delete', 'ClassController@delete')->name('class.delete');
		Route::post('change', 'ClassController@change')->name('class.change');
	});
	Route::prefix('my-request')->group(function(){
		Route::get('/', 'ClassController@getRequest');
	});
	Route::prefix('my-class')->group(function(){
		Route::get('/', 'ClassController@myClass')->name('class.myClass');
		Route::get('/{id}', 'ClassController@classByID')->name('myclass');
		Route::post('/{id}/upload', 'ClassController@uploadDocument');
		Route::post('/{id}/edit-document', 'ClassController@editDocument');
		Route::get('/{id}/delete-document', 'ClassController@deleteDocument');
		Route::get('/{id}/student-list', 'ClassController@getStudentList');
		Route::get('/{id}/accept-request', 'ClassController@acceptRequest');
		Route::post('/accept-invite', 'ClassController@acceptInvite');
		Route::post('/{id}/delete-student', 'ClassController@outClass');
		Route::post('/{id}/add-student', 'ClassController@inviteClass');
		Route::post('request', 'ClassController@requestJoin')->name('class.request');

		Route::post('/{id}/add-comment', 'ClassController@addComment');
		Route::get('/{id}/delete-comment', 'ClassController@deleteComment');
		Route::post('/{id}/edit-comment', 'ClassController@editComment');
		
		Route::post('/{id}/add-sub-comment', 'CommentController@addSubComment');
		Route::get('/{id}/delete-sub-comment', 'CommentController@deleteSubComment');
		Route::post('/{id}/edit-sub-comment', 'CommentController@editSubComment');

		Route::post('/{id}/assignment/save', 'AssignmentController@save');
	});

	Route::prefix('assignment')->group(function(){
		Route::get('/{id}', 'AssignmentController@get')->name('assignment');
		Route::post('/{id}/upload', 'AssignmentController@upload');
		Route::get('/{id}/delete-assignment-submit', 'AssignmentController@deleteSubmit');
	});
});
