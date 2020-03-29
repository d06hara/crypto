<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
    public function update(Request $request, $id)
    {

        $auth = User::find($id);

        $form = $request->all();

        unset($form['_token']);

        $auth->fill($form)->save();

        return redirect('/mypage')->with('flash_message', 'プロフィールを変更しました!');
    }
}
