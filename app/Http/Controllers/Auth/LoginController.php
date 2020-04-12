<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;


// logout機能追加のため
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // logout先変更のため書き換え
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/ranking';
    protected function redirectTo()
    {
        session()->flash('flash_message', 'ログインしました');
        return '/ranking';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:150',
            'password' => 'required|string|max:150',
        ]);
    }

    // logout機能作成
    public function Logout(Request $request)
    {
        $this->performLogout($request);
        // redirect先をカスタマイズ
        return redirect('/login');
    }
}
