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
}
