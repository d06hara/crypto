<?php

namespace App\Http\Controllers;

use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountController extends Controller
{

    // アカウント取得機能(api)
    public function accountIndex()
    {
        // return TwitterAccount::paginate(10);

        // return TwitterAccount::with(['users'])->paginate(10);

        $accounts = TwitterAccount::with('users')->get();
        // dd($accounts);
        $accounts = $accounts->toArray();
        // dd($accounts);
        foreach ($accounts as $key => &$value) {
            if (empty($value['users'])) {
                $value['users'] = false;
            } else {
                $value['users'] = true;
            };
        };

        $accounts = new LengthAwarePaginator(
            $accounts,
            count($accounts),
            10,
            1,
        );
        // $accounts = new LengthAwarePaginator(
        //     $accounts->forPage($request->page, 10),
        //     count($accounts),
        //     10,
        //     $request->page,
        // );
        // $accounts = json_encode($accounts);

        return $accounts;
    }
}
