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

// TOP
Route::get('/', 'IndexController@index');

// 打刻画面
Route::get('/stamp/{school_id?}', 'StampController@stamp');
Route::post('/stamp/start/{school_id?}', 'StampController@start');
Route::post('/stamp/end/{school_id?}', 'StampController@end');

// 認証
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// 管理者メニュー
Route::view('/admin', 'admin.menu')->middleware('auth');

// 利用者管理画面
Route::get('/user/{school_id?}', 'UserManagerController@index');
Route::post('/user', 'UserManagerController@select');
