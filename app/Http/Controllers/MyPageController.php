<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class MyPageController extends Controller
{
    /**
     * mypage表示
     */
    public function show()
    {
        // ユーザー情報取得
        $user = Auth::user();
        if (is_null($user)) {
            abort(404);
        }
        // twitter情報取得
        $twitter_account = Auth::user()->twitterUser;
        if (is_null($twitter_account)) {
            return view('/mypage', compact('user'));
        }

        return view('/mypage', compact('user', 'twitter_account'));
    }

    /**
     * 退会画面表示
     */
    public function withdraw()
    {
        $user = Auth::user();
        // dd($user);
        if (is_null($user)) {
            abort(404);
        }
        return view('/withdraw', compact('user'));
    }
}
