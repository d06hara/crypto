<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwittersController extends Controller
{
    // twitterアカウント一覧表示画面
    public function index()
    {

        return view('account');
    }
}
