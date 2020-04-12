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
use App\lib\TwitterAppAuth;
use Illuminate\Support\Carbon;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;


class TestController extends Controller
{

    public function test()
    {

        // Tweetテーブルの最終更新日時を取得
        $recent_time = Tweet::max('created_at');
        $time_for_hour = new Carbon($recent_time);
        $time_for_day = new Carbon($recent_time);
        $time_for_week = new Carbon($recent_time);

        // $a = strval($recent_time);

        // １時間前の時間を取得
        $before_one_hour = $time_for_hour->subHour(1);
        // $b = strval($before_one_hour);

        //  1日前の時間を取得
        $before_one_day = $time_for_day->subDay(1);
        // $c = strval($before_one_day);
        // １週間前の時間を取得
        $before_one_week = $time_for_week->subWeek(1);
        // $d = strval($before_one_week);
        // dd($a, $b, $c, $d);
        dd($recent_time, $before_one_hour, $before_one_day, $before_one_week);
    }
}
