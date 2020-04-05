<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use App\Models\TwitterUser;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Carbon;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;


class TestController extends Controller
{

    public function test()
    {
    }
}
