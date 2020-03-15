<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwitterUserController extends Controller
{
    //
    // フォロー
    public function follow()
    {
        // フォローする人
        $follower = auth()->user()->twitterUser;
    }
}
