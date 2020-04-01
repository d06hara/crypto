<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TwitterAccount extends Model
{
    //
    protected $fillable = [
        'twitter_id',
        'name',
        'screen_name',
        'description',
        'followers_count',
        'friends_count',
        'text',
        'created_at',
        'updated_at'
    ];

    // twitter_userとのリレーション
    public function users()
    {
        return $this->belongsToMany('App\Models\TwitterUser', 'user_accounts');
    }


    // twitterアカウント保存メソッド(引数はapiから取得したアカウントの配列)
    public static function accountStore(array $twitter_accounts)
    {
        if (is_array($twitter_accounts)) {

            // 取得した連想配列の数を取得
            $accounts_count = count($twitter_accounts);

            // 取得したアカウントの保存or更新処理を行う
            for ($i = 0; $i < $accounts_count; $i++) {
                // DB内に同じtwitter_idが保存されているかチェック
                $account = TwitterAccount::where('twitter_id', $twitter_accounts[$i]->id)->first();

                // ------------------------------------
                // twitter_idが保存されていなかった場合
                // 新規保存処理を行う
                // ------------------------------------
                if (empty($account)) {
                    // apiからのデータにstatusがあるかをチェック
                    if (empty($twitter_accounts[$i]->status)) {
                        // 無ければtextデータ以外を保存
                        TwitterAccount::create([
                            'twitter_id' => $twitter_accounts[$i]->id,
                            'name' => $twitter_accounts[$i]->name,
                            'screen_name' => $twitter_accounts[$i]->screen_name,
                            'description' => $twitter_accounts[$i]->description,
                            'followers_count' => $twitter_accounts[$i]->followers_count,
                            'friends_count' => $twitter_accounts[$i]->friends_count,
                            'updated_at' => Carbon::now(),
                            'created_at' => Carbon::now()
                        ]);
                    } else {
                        // statusがある場合
                        // textデータも含めて保存
                        TwitterAccount::create([
                            'twitter_id' => $twitter_accounts[$i]->id,
                            'name' => $twitter_accounts[$i]->name,
                            'screen_name' => $twitter_accounts[$i]->screen_name,
                            'description' => $twitter_accounts[$i]->description,
                            'followers_count' => $twitter_accounts[$i]->followers_count,
                            'friends_count' => $twitter_accounts[$i]->friends_count,
                            'text' => $twitter_accounts[$i]->status->text,
                            'updated_at' => Carbon::now(),
                            'created_at' => Carbon::now()
                        ]);
                    }

                    // TwitterAccount::updateOrInsert(
                    //     ['twitter_id' => $twitter_accounts[$i]->id],
                    //     [
                    //         'name' => $twitter_accounts[$i]->name,
                    //         'screen_name' => $twitter_accounts[$i]->screen_name,
                    //         'description' => $twitter_accounts[$i]->description,
                    //         'followers_count' => $twitter_accounts[$i]->followers_count,
                    //         'friends_count' => $twitter_accounts[$i]->friends_count,
                    //         'text' => $twitter_accounts[$i]->status->text
                    //     ]
                    // );
                } else {
                    // ------------------------------------------
                    // twitter_idが既に保存されている場合
                    // 更新処理を行う
                    // 更新は１日に１回行う,updated_atをチェックして処理を分ける
                    // ------------------------------------------

                    // アカウントから更新日のみ取得
                    $updated_at = $account->updated_at;
                    // 更新日が前日以降の(またはnull)場合のみ更新処理を行う
                    if (is_null($updated_at) || !($updated_at->isToday())) {

                        // statusの有無で処理を分ける
                        if (empty($twitter_accounts[$i]->status)) {
                            // statusが無い場合、textデータ以外を更新
                            $account->name = $twitter_accounts[$i]->name;
                            $account->screen_name = $twitter_accounts[$i]->screen_name;
                            $account->description = $twitter_accounts[$i]->description;
                            $account->followers_count = $twitter_accounts[$i]->followers_count;
                            $account->friends_count = $twitter_accounts[$i]->friends_count;
                            // updated_atを更新
                            $account->updated_at = Carbon::now();

                            $account->save();
                        } else {
                            // statusがある場合,textデータも含めて更新
                            $account->name = $twitter_accounts[$i]->name;
                            $account->screen_name = $twitter_accounts[$i]->screen_name;
                            $account->description = $twitter_accounts[$i]->description;
                            $account->followers_count = $twitter_accounts[$i]->followers_count;
                            $account->friends_count = $twitter_accounts[$i]->friends_count;
                            $account->text = $twitter_accounts[$i]->status->text;
                            // updated_atを更新
                            $account->updated_at = Carbon::now();

                            $account->save();
                        }
                    }
                }
            }
        }
    }
}
