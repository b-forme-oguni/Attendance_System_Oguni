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

Route::get('/', 'IndexController@index');

Route::get('stamp/{school_id?}', 'StampController@stamp');
Route::post('stamp/start/{school_id?}', 'StampController@start');
Route::post('stamp/end/{school_id?}', 'StampController@end');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
