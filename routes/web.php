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
Route::prefix('stamp')->group(function () {
    Route::get('/{school_id?}', 'StampController@stamp');
    Route::post('/start/{school_id?}', 'StampController@start');
    Route::post('/end/{school_id?}', 'StampController@end');
});

// 【認証】
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// 【管理者画面】
// 管理者画面全てのルートに対してauthミドルウェアを指定
Route::group(['middleware' => ['auth']], function () {

    // 【管理者メニュー】
    Route::get('/menu', 'MenuController@menu');

    // 【利用者管理】
    Route::prefix('user')->group(function () {
        // 利用者一覧表示
        Route::get('/', 'UserManagerController@index');
        // 利用者登録
        Route::get('/store', 'UserManagerController@register');
        Route::post('/store', 'UserManagerController@store');
        // 利用者情報変更
        Route::get('/edit', 'UserManagerController@edit');
        Route::post('/edit', 'UserManagerController@update');
        Route::get('/delete', 'UserManagerController@delete');
        // 利用者削除管理
        Route::get('/deleteindex', 'UserManagerController@deleteindex');
        Route::post('/revival', 'UserManagerController@revival');
        Route::post('/truedelete', 'UserManagerController@truedelete');
    });


    // 【実績記録管理】
    // 実績記録一覧表示
    Route::get('/performance', 'PerformanceController@index');
    // 実績記録登録
    Route::get('/performance_reg', 'PerformanceController@register');
    Route::post('/performance_reg', 'PerformanceController@store');
    // 実績記録情報変更
    Route::get('/performance_edit', 'PerformanceController@edit');
    Route::post('/performance_edit', 'PerformanceController@update');
    Route::get('/performance_del', 'PerformanceController@delete');


    Route::get('/user/export', 'UserManagerController@export');

    Route::get('/output/index', 'ExportController@index');
    Route::get('/output/preview', 'ExportController@preview');
    Route::get('/output/export', 'ExportController@export');
});
