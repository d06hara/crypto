<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return $user;
    }
}
