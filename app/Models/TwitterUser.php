<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterUser extends Model
{
    protected $fillable = [
        'user_id',
        'twitter_id',
        'token',
        'tokenSecret',
        'nickname',
        'name'
    ];
    //Userとのリレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
