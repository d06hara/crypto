<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function accountIndex()
    {
        // return TwitterAccount::paginate(10);
        return TwitterAccount::paginate(10);
    }
}
