<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class MyPageController extends Controller
{
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
