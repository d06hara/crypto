<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NewsController extends Controller
{

    // 仮想通貨ニュース取得
    function get_news(Request $request)
    {

        set_time_limit(90);

        $keyword = '仮想通貨';
        //----キーワードの文字コード変更
        $query = urlencode(mb_convert_encoding($keyword, "UTF-8", "auto"));

        //---- キーワード検索したいときのベースURL
        // $API_BASE_URL = "https://news.google.com/search?hl=ja&ned=us&ie=UTF-8&oe=UTF-8&output=atom&q=";
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
        // dd($list);
        // $list = array($list);
        // $list_data = array_chunk($list, 10);


        // $list = array_chunk($list, 10);
        // $list = new Collection($list);
        // $list = json_encode($list);
        // dd($list);
        // dd($list);
        // return $list->paginate(10);

        // ページネーション化
        // $news = new LengthAwarePaginator($list, count($list), 10, 1);
        // return $news;
        // dd($news);
        // return $list->forpage($request->page, 10);
        // $list = new Collection($list);
        // $news = new LengthAwarePaginator(
        //     $list->forPage(2, 10),
        //     count($list),
        //     10,
        //     $request->page,
        // );

        // 配列を分割
        $list_data = array_chunk($list, 10);
        $news = new LengthAwarePaginator(
            $list_data[$request->page],
            count($list),
            10,
            $request->page,
        );

        return $news;



        // dd($news);

        // foreach($xml->channel->item as $item){
        //     $title = $item->title;

        //     $date = date(""Y年 n月 j日"", strtotime($item->pubDate));
        //     $link = $item->link;

        //     $description = strip_tags($item->description);

        //     dd($title);
        // }

        //記事のタイトルとURLを取り出して配列に格納
        // for ($i = 0; $i < count($data); $i++) {
        //     $list = [];

        //     $list[$i]['title'] = mb_convert_encoding($data[$i]->title, "UTF-8", "auto");
        //     $url_split =  explode("=", (string) $data[$i]->link->attributes()->href);
        //     $list[$i]['url'] = end($url_split);
        //     // dd($list);
        // }
        // // dd($list);
        // $list_gn = $list->paginate(10);



        //$max_num以上の記事数の場合は切り捨て
        // if (count($list) > $max_num) {
        //     for ($i = 0; $i < $max_num; $i++) {
        //         $list_gn[$i] = $list[$i];
        //     }
        // } else {
        //     $list_gn = $list;
        // }
        // dd($list_gn);


        // return view('news', [
        //     // 'list_gn' => $list_gn,
        //     'news' => $news
        // ]);
        // $newsData = json_encode($news);
        // // return view('news')->with('newsData', $newsData);
        // return $newsData;
    }
}
