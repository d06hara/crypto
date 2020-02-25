<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Follower;
use App\Models\TwitterUser;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ユーザー一覧機能のテスト
    public function index(User $user)
    {
        // $md = new User();
        $data = $user->getAllUsers(auth()->user()->id);
        // dd($data);
        // $data = User::all();

        // dd($data);

        return view('users.index', [
            'data'  => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // フォロー
    public function follow()
    {
        // ログインしているユーザーの情報を取得
        $follower = auth()->user();
        // dd($follower);
        // フォローしているか(会員登録していないアカウントをフォローする場合は変更する必要がある)
        // $is_following = $follower->isFollowing($user->id);
        $is_following = $follower->isFollowing($user->id);
        dd($is_following);
        if (!$is_following) {
            // フォローしていなければフォローする
            // $aa = $user->twitterUser->provider_user_id;
            // dd($aa);
            // dd($user->twitterUser()->provider_user_id);
            $follower->follow($user->twitterUser->provider_user_id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if ($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}
