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

use Illuminate\Http\Request;

// 認証系
Auth::routes();

Route::get('/', function () {
    return view('home');
})->name('/');


// ログイン認証を必要にする
Route::group(['middleware' => 'auth'], function () {

    // ランキングページ関連
    //----------------------------
    // ランキング画面表示
    Route::get('/ranking', function () {
        return view('ranking');
    })->name('ranking');
    // ランキング機能
    Route::get('/api/ranking', 'RankingController@getTweetCount');
    //----------------------------


    // アカウントページ関連
    //----------------------------
    // アカウント画面表示
    Route::get('/account', 'AccountController@index')->name('account');
    // アカウント呼び出しapi
    Route::get('api/account', 'AccountController@accountIndex');
    // ボタンからフォロー アンフォロー
    Route::post('/account/follow', 'AccountController@accountFollow');
    Route::post('/account/unfollow', 'AccountController@accountUnfollow');
    // 自動フォロー(start, stop)
    Route::post('/account/start', 'AccountController@autoFollowStart');
    Route::post('/account/stop', 'AccountController@autoFollowStop');

    // twitter連携処理
    Route::get('/twitter', 'AuthController@twitter');
    Route::get('/twitter/callback', 'AuthController@twitterCallback');
    //----------------------------


    // ニュースページ関連
    //----------------------------
    // news画面表示
    Route::get('/news', function () {
        return view('news');
    });
    // news取得api
    Route::get('api/news', 'NewsController@get_news');
    //----------------------------




    // マイページ関連
    //----------------------------
    // マイページ表示

    Route::get('/mypage', 'MyPageController@show');
    // プロフィール編集画面表示
    Route::get('/edit', 'MyPageController@edit');
    // プロフィール編集機能
    Route::post('/update/{id}/', 'MyPageController@update')->name('update');

    // 退会画面表示
    Route::get('/withdraw', 'MyPageController@withdraw');
    // 退会処理
    Route::post('/delete/{id}/', 'MyPageController@delete')->name('delete');
});
