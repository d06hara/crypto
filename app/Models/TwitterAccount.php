<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterAccount extends Model
{
    //
    protected $fillable = ['twitter_id'];

    // twitterアカウント保存メソッド
    public static function accountStore(array $twitter_accounts)
    {
        if (is_array($twitter_accounts)) {

            // 取得した連想配列の数を取得
            $accounts_count = count($twitter_accounts);
            // print_r($twitter_accounts);

            for ($i = 0; $i < $accounts_count; $i++) {

                TwitterAccount::updateOrInsert(
                    ['twitter_id' => $twitter_accounts[$i]->id],
                    [
                        'name' => $twitter_accounts[$i]->name,
                        'screen_name' => $twitter_accounts[$i]->screen_name,
                        'description' => $twitter_accounts[$i]->description,
                        'followers_count' => $twitter_accounts[$i]->followers_count,
                        'friends_count' => $twitter_accounts[$i]->friends_count,
                        'text' => $twitter_accounts[$i]->status->text
                    ]
                );
            }
        }
    }
}
