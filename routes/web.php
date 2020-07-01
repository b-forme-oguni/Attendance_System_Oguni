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

// 【利用者打刻画面】
Route::prefix('stamp')->group(function () {
    Route::get('/{school_id?}', 'StampController@stamp');
    Route::post('/start/{school_id?}', 'StampController@start');
    Route::post('/end/{school_id?}', 'StampController@end');
});

// 【認証】
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// 【管理者編集画面】
// 管理者画面全てのルートに対してauthミドルウェアを指定
Route::group(['middleware' => ['auth']], function () {

    // 【管理者メニュー】
    Route::get('menu', 'MenuController@menu');

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
    Route::prefix('performance')->group(function () {
        // 実績記録一覧表示
        Route::get('/', 'PerformanceController@index');
        // 実績記録登録
        Route::get('/store', 'PerformanceController@register');
        Route::post('/store', 'PerformanceController@store');
        // 実績記録変更
        Route::get('/edit', 'PerformanceController@edit');
        Route::post('/edit', 'PerformanceController@update');
        // 実績記録削除
        Route::get('/delete', 'PerformanceController@delete');
    });

    // 【実績記録Excel出力】
    Route::prefix('preview')->group(function () {
        // 月ごとの出力対象者一覧表示
        // Route::get('/', 'ExportController@index');
        // Excel出力プレビュー表示
        Route::get('/', 'ExportController@preview');
        // Excel出力
        Route::get('/export', 'ExportController@export');
    });
});
