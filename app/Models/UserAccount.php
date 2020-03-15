<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    // protected $primaryKey = [
    //     'following_id',
    //     'followed_id'
    // ];
    protected $fillabel = [
        'twitter_user_id',
        'twitter_account_id'
    ];
    public $timestamps = false;
    public $incrementing = false;
}
