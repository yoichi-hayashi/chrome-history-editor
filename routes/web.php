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

Route::get('/', 'RandomGeneratorController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::get('generate', 'RandomGeneratorController@generate')->name('random-numbers.generate');
    Route::get('logform', 'HistoryLogController@index')->name('logform.get');
    Route::post('log/store', 'HistoryLogController@store')->name('log.store');
    Route::get('log/search', 'HistoryLogController@search')->name('log.search');
    Route::get('sqlgenerator', 'SqlGeneratorController@index')->name('sqlgenerator.get');
});
