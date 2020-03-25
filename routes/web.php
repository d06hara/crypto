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

use App\Http\Controllers\TwittersController;
use App\Models\User;
use Illuminate\Http\Request;

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



// ---------------------------------------------
// 一時確定
// ---------------------------------------------

// ログイン認証を必要にする
Route::group(['middleware' => 'auth'], function () {

    Route::get('/mypage', function () {
        return view('mypage');
    });
    Route::get('api/mypage', 'MypageController@show');


    // ----------------------
    // twitterアカウント表示画面
    Route::get('/account', 'TwittersController@index')->name('account');

    Route::get('api/account', 'AccountController@accountIndex');



    // ボタンからフォロー
    Route::post('/account/follow', 'TwittersController@accountFollow');

    // 自動フォロー
    Route::post('/account/start', 'TwittersController@autoFollowStart');
    Route::post('/account/stop', 'TwittersController@autoFollowStop');

    // ----------------------

    // Route::middleware(['cors'])->group(function () {
    //     Route::post('/account/follow', 'TwittersController@accountFollow');
    // });

    Route::get('/ranking', function () {
        return view('ranking');
    })->name('ranking');
    // ranking画面
    Route::get('/api/ranking', 'TwittersController@getTweetCount');

    // news画面
    Route::get('/news', function () {
        return view('news');
    });
    Route::get('api/news', 'NewsController@get_news');
    // Route::get('/news', 'NewsController@get_news')->name('news');

    Route::get('/withdraw', function () {
        return view(('withdraw'));
    });
    Route::get('/twitter', 'AuthController@twitter');
    Route::get('/twitter/callback', 'AuthController@twitterCallback');
    // Route::get('/twitter', 'Auth\LoginController@redirectToProvider');
    // Route::get('/twitter/callback', 'Auth\LoginController@handleProviderCallback');
});



// ---------------------------
// socialite使用
// ---------------------------
// 新規登録
// Route::get('/register/{provider}', 'Auth\RegisterController@redirectToProvider');
// Route::get('register/{provider}/callback', 'Auth\RegisterController@handleProviderCallbac');

// ログイン
Route::get('/login/twitter', 'Auth\LoginController@redirectToProvider');
Route::get('/login/twitter/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/account/twitter', 'TwittersController@addTwitterAccount');


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




// テスト用ページ
Route::get('/test', 'TestController@test');
// Route::get('/account', 'TwittersController@index');
