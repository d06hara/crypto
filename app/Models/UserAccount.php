<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{

    protected $fillabel = [
        'twitter_user_id',
        'twitter_account_id'
    ];
    public $timestamps = false;
    public $incrementing = false;
}
