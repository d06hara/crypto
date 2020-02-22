<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    // ---------------------------------------------------------------
    // グーグルニュース検索・データ取得関数 atom
    //
    //
    /* ---------------- 以下、設定部分 ------------------------------ */

    //$keyword:ニュース検索のキーワード
    //$max_num:取得記事数の上限

    function get_news()
    {
        set_time_limit(90);

        $keyword = '仮想通貨';
        $max_num = 5;
        //----　キーワードの文字コード変更
        $query = urlencode(mb_convert_encoding($keyword, "UTF-8", "auto"));

        //---- キーワード検索したいときのベースURL 
        // $API_BASE_URL = "https://news.google.com/news?hl=ja&ned=us&ie=UTF-8&oe=UTF-8&output=atom&q=";
        // $API_BASE_URL = "https://news.google.com/search?hl=ja&ned=us&ie=UTF-8&oe=UTF-8&output=atom&q=";
        $api_url = "https://news.google.com/rss/search?q=" . $query . "&hl=ja&gl=JP&ceid=JP:ja";
        // dd($api_url);



        // dd($query);

        //---- APIへのリクエストURL生成
        // $api_url = $API_BASE_URL . $query;

        // dd($api_url);

        //---- APIにアクセス、結果をsimplexmlに格納
        $contents = file_get_contents($api_url);
        // dd($contents);
        $xml = simplexml_load_string($contents);
        // $xml = simplexml_load_string($contents, 'SimpleXMLElement', LIBXML_NOCDATA);

        // print_r($xml);
        // dd($xml);
        // $json = json_encode($xml);
        // dd($json);
        // print_r($json);
        // $array = json_decode($json, true);
        // dd($array);

        //記事エントリを取り出す
        $items = $xml->channel->item;
        // $data = $xml->channel;
        // $count = count($items);
        // 記事のタイトルとURLを取り出して配列に格納
        for ($i = 0; $i < count($items); $i++) {

            // 記事タイトル
            $list[$i]['title'] = mb_convert_encoding($items[$i]->title, "UTF-8", "auto");
            // 記事のリンク
            $list[$i]['url'] = (string) $items[$i]->link;
            // 記事の発行日時
            $list[$i]['pubDate'] =  date('Y/m/d H:i', strtotime($items[$i]->pubDate));
            // 記事ソース
            $list[$i]['source'] = (string) $items[$i]->source;
            // $url_split =  explode("=", (string) $items[$i]->link->attributes()->href);
            // $list[$i]['url'] = end($url_split);
        }
        // dd($list);
        // dd(count($list));
        // dd($count);
        // dd($items);
        // $item = $data->item;
        // dd($item);

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

        //$max_num以上の記事数の場合は切り捨て
        if (count($list) > $max_num) {
            for ($i = 0; $i < $max_num; $i++) {
                $list_gn[$i] = $list[$i];
            }
        } else {
            $list_gn = $list;
        }
        // dd($list_gn);


        return view('news', [
            'list_gn' => $list_gn
        ]);
    }
}
