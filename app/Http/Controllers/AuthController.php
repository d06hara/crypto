<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return Socialite::with('Twitter')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('Twitter')->user();
        dd($user);
    }
}
