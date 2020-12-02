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

Route::get('login', 'LoginController@login')->name('login');
Route::post('login', 'LoginController@postLogin');
Route::post('logout', 'LoginController@logout')->name('logout');

Route::get('freelab', 'IndexController@freelab');
Route::post('freelab-store', 'IndexController@postfreelab');

Route::group(['middleware' => 'auth'], function() {
	Route::get('', 'LabController@index')->name('dashboard');
	Route::post('lab/check', 'LabController@create');
	Route::post('lab/create', 'LabController@store');
	Route::post('lab/{id}/edit', 'LabController@edit');
	Route::post('lab/{id}/update', 'LabController@update');
	Route::post('lab/{id}/remove', 'LabController@destroy');

	Route::get('accounts', 'AccountsController@getAccounts');
	Route::post('accounts', 'AccountsController@index');
	Route::post('accounts/addUser', 'AccountsController@store')->name('addUser');
	Route::post('accounts/{id}', 'AccountsController@edit');
	Route::post('accounts/{id}/update', 'AccountsController@update');
	Route::post('accounts/{id}/changepass', 'AccountsController@changepass');
	Route::post('accounts/{id}/delete', 'AccountsController@destroy');

	Route::get('schedules', 'CalendarController@index');
	Route::post('schedules/store', 'CalendarController@store');

	Route::any('logs', 'IndexController@logs');
});
