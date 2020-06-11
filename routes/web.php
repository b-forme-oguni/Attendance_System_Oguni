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

// 【TOP】
Route::get('/', 'MenuController@top');

// 【打刻】
Route::get('/stamp/{school_id?}', 'StampController@stamp');
Route::post('/stamp/start/{school_id?}', 'StampController@start');
Route::post('/stamp/end/{school_id?}', 'StampController@end');

// 【認証】
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// 【管理者メニュー】
Route::get('/admin', 'MenuController@adminMenu')->middleware('auth');

// 【利用者管理】
// 利用者一覧表示
Route::get('/user/{school_id?}', 'UserManagerController@index');
// 利用者登録
Route::get('/user_reg', 'UserManagerController@register');
Route::post('/user_reg', 'UserManagerController@store');
// 利用者情報変更
Route::get('/user_edit', 'UserManagerController@edit');
Route::post('/user_edit', 'UserManagerController@update');
Route::get('/user_del', 'UserManagerController@delete');
// 利用者削除管理
Route::get('/delete/{school_id?}', 'UserManagerController@deleteindex');
Route::post('/revival/{school_id?}', 'UserManagerController@revival');
Route::post('/truedelete/{school_id?}', 'UserManagerController@truedelete');

// 【実績記録管理】
// 実績記録一覧表示
Route::get('/performance/{school_id?}', 'PerformanceController@index');
// 実績記録登録
Route::get('/performance_reg', 'PerformanceController@register');
Route::post('/performance_reg', 'PerformanceController@store');
// 実績記録情報変更
Route::get('/performance_edit', 'PerformanceController@edit');
Route::post('/performance_edit', 'PerformanceController@update');
Route::get('/performance_del', 'PerformanceController@delete');
