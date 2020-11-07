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

Route::get('', 'IndexController@dashboard')->name('dashboard');
Route::get('accounts', 'AccountsController@getAccounts');
Route::post('accounts', 'AccountsController@index');
Route::post('accounts/addUser', 'AccountsController@addUser')->name('addUser');
Route::post('change-password', 'AccountsController@store')->name('change.password');

Route::get('freelab', 'IndexController@freelab');
Route::post('freelab-store', 'IndexController@postfreelab');