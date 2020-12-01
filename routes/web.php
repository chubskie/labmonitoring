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
	Route::get('', 'IndexController@dashboard')->name('dashboard');
	Route::get('accounts', 'AccountsController@getAccounts');
	Route::post('accounts', 'AccountsController@index');
	Route::post('accounts/addUser', 'AccountsController@store')->name('addUser');
	Route::post('accounts/{id}', 'AccountsController@edit');
	Route::post('accounts/{id}/update', 'AccountsController@update');
	Route::post('accounts/{id}/changepass', 'AccountsController@changepass');
	Route::post('accounts/{id}/delete', 'AccountsController@destroy');

	Route::get('schedules', 'CalendarController@index');
	Route::get('logs', 'IndexController@logs');
});
