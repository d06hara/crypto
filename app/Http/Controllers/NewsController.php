<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NewsController extends Controller
{

    /**
     * 仮想通貨ニュース取得機能
     */
    function get_news(Request $request)
    {
        // 10ページ目以上がgetされた時
        if ($request->page >= 10) {
            abort(404);
        }

        set_time_limit(90);

        $keyword = '仮想通貨';
        //キーワードの文字コード変更
        $query = urlencode(mb_convert_encoding($keyword, "UTF-8", "auto"));
        //url生成
        $api_url = "https://news.google.com/rss/search?q=" . $query . "&hl=ja&gl=JP&ceid=JP:ja";


        //---- APIにアクセス、結果をsimplexmlに格納
        $contents = file_get_contents($api_url);

        if (is_null($contents)) {
            abort(404);
        }

        $xml = simplexml_load_string($contents);

        //記事エントリを取り出す
        $items = $xml->channel->item;

        // 記事のタイトルとURLを取り出して配列に格納
        $list = [];
        for ($i = 0; $i < count($items); $i++) {
            // 記事タイトル
            $list[$i]['title'] = mb_convert_encoding($items[$i]->title, "UTF-8", "auto");
            // 記事のリンク
            $list[$i]['url'] = (string) $items[$i]->link;
            // 記事の発行日時
            $list[$i]['pubDate'] =  date('Y/m/d H:i', strtotime($items[$i]->pubDate));
            // 記事ソース
            $list[$i]['source'] = (string) $items[$i]->source;
        }

        // 配列を分割し、vueに渡す
        $list_data = array_chunk($list, 10);

        $news = $list_data[$request->page];

        return $news;
    }
}
