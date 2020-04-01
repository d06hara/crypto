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
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
})->name('/');


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

    // マイページ表示
    Route::get('/mypage', 'MypageController@show');
    // プロフィール編集画面表示
    Route::get('/edit', 'MypageController@edit');
    // プロフィール編集機能
    Route::post('/updata/{id}/', 'MypageController@update')->name('update');
    // パスワード編集画面表示
    Route::get('/passedit', function () {
        return view('passedit');
    });
    // パスワード編集機能
    Route::post('/passedit/change', 'MypageController@changePass')->name('changepass');

    Route::get('/withdraw', 'MypageController@withdraw');
    Route::post('/delete/{id}/', 'MypageController@delete')->name('delete');
    // Route::get('api/mypage', 'MypageController@show');


    // ----------------------

    // Route::middleware(['cors'])->group(function () {
    //     Route::post('/account/follow', 'TwittersController@accountFollow');
    // });



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
