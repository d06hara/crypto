<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ValidateEditRequest;
use App\Http\Requests\ValidChangePassRequest;

class MyPageController extends Controller
{
    /**
     * mypage表示
     */
    public function show()
    {
        // ユーザー情報取得
        // $user = auth()->user();
        $user = Auth::user();
        // // dd($user);
        // if (is_null($user)) {
        //     abort(404);
        // }
        // // twitter情報取得
        // $twitter_account = Auth::user()->twitterUser;
        // if (is_null($twitter_account)) {
        //     return view('/mypage', compact('user'));
        // }

        // return view('/mypage', compact('user', 'twitter_account'));
        return view('mypage', compact('user'));
    }

    /**
     * プロフィール編集画面表示
     */
    public function edit()
    {
        // ユーザー情報取得
        $user = auth()->user();
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
     * パスワード変更処理
     */
    public function changePass(ValidChangePassRequest $request)
    {

        //現在のパスワードが正しいかを調べる(これだけRequestクラスと別でチェック)
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return redirect()->back()->with('error', '現在のパスワードが間違っています');
        }
        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect('/mypage')->with('flash_message', 'パスワードを変更しました。');
    }

    /**
     * 退会画面表示
     */
    public function withdraw()
    {
        $user = auth()->user();
        // dd($user);
        if (is_null($user)) {
            abort(404);
        }
        return view('/withdraw', compact('user'));
    }

    /**
     * 退会処理
     */
    public function delete($id)
    {

        $user_id = Auth::id();

        $auth = User::find($id);
        if (is_null($auth)) {
            abort(404);
        }

        if ($user_id !== $auth->id) {
            abort(403);
        }

        User::find($id)->delete();
        return redirect('/login')->with('flaeh_message', '退会が完了しました。');
    }
}
