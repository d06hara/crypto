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
    public function show()
    {
        $user = auth()->user();
        // dd($user);
        return view('/mypage', compact('user'));
    }
    public function edit()
    {
        $user = auth()->user();
        return view('/edit', compact('user'));
    }
    public function update(ValidateEditRequest $request, $id)
    {

        $auth = User::find($id);

        $form = $request->all();

        unset($form['_token']);

        $auth->fill($form)->save();

        return redirect('/mypage')->with('flash_message', 'プロフィールを変更しました!');
    }

    public function changePass(ValidChangePassRequest $request)
    {

        //パスワードのバリデーション。新しいパスワードは8文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
        // $validated_data = $request->validate([
        //     'old_password' => 'required',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        //現在のパスワードが正しいかを調べる
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return redirect()->back()->withErrors('現在のパスワードが間違っています');
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if (strcmp($request->get('old_password'), $request->get('password')) == 0) {
            return redirect()->back();
        }

        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('/mypage')->with('flash_message', 'パスワードを変更しました。');
    }
}
