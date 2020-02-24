<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterUser extends Model
{
    //Userとのリレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
