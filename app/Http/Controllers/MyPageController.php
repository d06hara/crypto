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
    // mypage表示
    public function show()
    {
        // ユーザー情報取得
        $user = auth()->user();
        // twitter情報取得
        $twitter_account = auth()->user()->twitterUser;
        // dd($user);
        return view('/mypage', compact('user', 'twitter_account'));
    }

    // プロフィール編集画面表示
    public function edit()
    {
        $user = auth()->user();
        return view('/edit', compact('user'));
    }

    // プロフィール編集処理
    public function update(ValidateEditRequest $request, $id)
    {

        $auth = User::find($id);

        $form = $request->all();

        unset($form['_token']);

        $auth->fill($form)->save();

        return redirect('/mypage')->with('flash_message', 'プロフィールを変更しました!');
    }

    // パスワード変更処理
    public function changePass(ValidChangePassRequest $request)
    {

        //現在のパスワードが正しいかを調べる(これだけ別でチェック)
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return redirect()->back()->with('error', '現在のパスワードが間違っています');
        }

        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect('/mypage')->with('flash_message', 'パスワードを変更しました。');
    }

    // 退会画面表示
    public function withdraw()
    {
        $user = auth()->user();
        return view('/withdraw', compact('user'));
    }

    // 退会処理
    public function delete($id)
    {
        User::find($id)->delete();
        return redirect('/login')->with('flaeh_message', '退会が完了しました。');
    }
}
