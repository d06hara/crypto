<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bland extends Model
{
    //tweetモデルとのリレーション
    // 銘柄が重複したツイートはそれぞれの銘柄で１つずつ保存しているため
    // １対多の関係
    public function tweets()
    {
        return $this->hasMany('App\Tweet');
    }
}
