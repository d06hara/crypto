<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function accountIndex()
    {
        // return TwitterAccount::paginate(10);
        return TwitterAccount::with(['users'])->paginate(10);
        // $a = TwitterAccount::with(['users']);
        // $a->transform(function ($item, $key) {
        //     if ($key->users) {
        //         return $key->users = true;
        //     }
        //     return $key->users = false;
        // });
        // dd($a);
        // foreach ($a as $b) {
        //     if ($b->users) {
        //         return $b->users = true;
        //     }
        //     return $b->users = false;
        // }
        // return $a->paginate(10);
    }
}
