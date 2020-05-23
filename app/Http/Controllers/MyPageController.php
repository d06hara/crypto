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
     * プロフィール編集画面表示
     */
    public function edit()
    {
        // ユーザー情報取得
        $user = Auth::user();
        if (is_null($user)) {
            abort(404);
        }
        return view('/edit', compact('user'));
    }

    /**
     * プロフィール編集処理
     */
    public function update(ValidateEditRequest $request, $id)
    {
        $user_id = Auth::id();

        $auth = User::find($id);
        if (is_null($auth)) {
            abort(404);
        }

        if ($user_id !== $auth->id) {
            abort(403);
        }

        $form = $request->all();

        unset($form['_token']);

        $auth->fill($form)->save();

        return redirect('/mypage')->with('flash_message', 'プロフィールを変更しました!');
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
