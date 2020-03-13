<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bland extends Model
{

    // 論理削除
    use SoftDeletes;

    protected $fillable = ['bland_name'];


    //tweetモデルとのリレーション
    // 銘柄が重複したツイートはそれぞれの銘柄で１つずつ保存しているため
    // １対多の関係
    public function tweets()
    {
        return $this->hasMany('App\Models\Tweet');
    }
}
