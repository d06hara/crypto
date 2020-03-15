<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Follower extends Pivot
{
    protected $primaryKey = [
        'following_id',
        'followed_id'
    ];
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
    public $timestamps = false;
    public $incrementing = false;
}
