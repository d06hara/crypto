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

Route::get('/', function () {
    return view('welcome');
});

// API以外のリクエストに対しては全てindexテンプレートを返す
// anyはなんでも良い⇨正規化
// 画面遷移はvuerouterを使用
// Route::get('/{any?}', function () {
//     return view('index');
// })->where('any', '.+');

Route::get('/mypage', function () {
    return view('mypage');
});

// ツイート取得テスト
Route::get('twitter', 'TwitterController@index');
// ハッシュタグテスト
Route::get('hash', 'TwitterController@sample');
// // twitterログインテスト
// Route::get('/login/twitter', 'Auth\LoginController@redirectToProvider');
// // twitter認証後のコールバック先
// Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderCallback');

// Auth Twitter
Route::get('auth/twitter', 'Auth\AuthController@TwitterRedirect')->name('auth.twitter');
Route::get('auth/twitter/callback', 'Auth\AuthController@TwitterCallback');
Route::get('auth/twitter/logout', 'Auth\AuthController@getLogout');



// 認証系
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// 画面作成のため一時
Route::get('/home', function () {
    return view('home');
});
Route::get('/account', function () {
    return view('account');
});
Route::get('/news', function () {
    return view('news');
});
Route::get('/passremind', function () {
    return view('passremind');
});
Route::get('/passremindsend', function () {
    return view('passremindsend');
});
Route::get('/passremindedit', function () {
    return view('passremindedit');
});
Route::get('/withdraw', function () {
    return view('withdraw');
});
Route::get('/passEdit', function () {
    return view('passEdit');
});
Route::get('/edit', function () {
    return view('edit');
});
