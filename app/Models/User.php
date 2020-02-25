<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // twitterユーザーとのリレーション
    public function twitterUser()
    {
        return $this->hasOne('App\Models\TwitterUser', 'user_id');
    }


    // フォロー機能のリレーション
    // 第二引数： 結合テーブル名
    // 第三引数： リレーションを定義しているモデルの外部キー名
    // 第四引数： 結合するモデルの外部キー名
    // -----------------------------
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }
    // -----------------------------

    // テスト用ユーザー表示機能
    public function getAllUsers(Int $user_id)
    {
        // ログインしているユーザーを除くユーザーを取得
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }

    // フォローする
    public function follow(Int $twitter_id)
    {
        return $this->follows()->attach($twitter_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか(自分が引数のidをフォローしているかをチェック)
    public function isFollowing(Int $provider_user_id)
    {
        return (bool) $this->follows()->where('followed_id', $provider_user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (bool) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
}
