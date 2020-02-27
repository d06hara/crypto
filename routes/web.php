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

use App\Models\User;

// 認証系
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

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


// ---------------------------------------------
// 一時確定
// ---------------------------------------------

// twitterアカウント表示画面
// Route::get('/account', 'TwittersController@index')->name('account');
Route::get('/account', function () {
    return view('account');
});

// ranking画面
Route::get('/ranking', 'TwittersController@getTweetCount')->name('ranking');

// news画面
Route::get('/news', 'NewsController@get_news')->name('news');

// socialite使用

// Route::get('auth/twitter', 'TwittersController@twitterLogin');
// Route::get('auth/twitter/callback', 'TwittersController@callback');




// ---------------------------------------------




// ---------------------------------------------
// テストrouting
// ---------------------------------------------

// ログイン認証
Route::group(['middleware' => 'auth'], function () {
    // ユーザー一覧
    Route::get('/users/index', 'UsersController@index');
    // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
});


Route::prefix('auth')->group(function () {
    Route::get('twitter', 'Auth\SocialAuthController@login');
    Route::get('twitter/callback', 'Auth\SocialAuthController@callback');
});





// ---------------------------------------------


// // ツイート取得テスト
// Route::get('twitter', 'TwitterController@index');
// // ハッシュタグテスト
// Route::get('hash', 'TwitterController@sample');
// // twitterログインテスト
// Route::get('/login/twitter', 'Auth\LoginController@redirectToProvider');
// // twitter認証後のコールバック先
// Route::get('login/twitter/callback', 'Auth\LoginController@handleProviderCallback');

// Auth Twitter
// Route::get('auth/twitter', 'Auth\SocialAuthController@redirectToProvider');
// Route::get('auth/twitter/callback', 'Auth\SocialAuthController@handleProviderCallback');
// Route::get('auth/twitter/logout', 'Auth\SocialAuthController@logout');










// 画面作成のため一時
// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/account', function () {
//     return view('account');
// });
// Route::get('/news', function () {
//     return view('news');
// });
// Route::get('/passremind', function () {
//     return view('passremind');
// });
// Route::get('/passremindsend', function () {
//     return view('passremindsend');
// });
// Route::get('/passremindedit', function () {
//     return view('passremindedit');
// });
// Route::get('/withdraw', function () {
//     return view('withdraw');
// });
// Route::get('/passEdit', function () {
//     return view('passEdit');
// });
// Route::get('/edit', function () {
//     return view('edit');
// });
// Route::get('/ranking', function () {
//     return view('ranking');
// });
// vueテスト
Route::get('/test', function () {
    return view('test');
});

Route::get('/aaa', function () {
    $user = User::all()->take(5);
    return $user;
});

// twitter account取得のデータ先
Route::get('/api/account', 'TwittersController@index');

// Route::get("/api/test", 'TwittersController@test');
