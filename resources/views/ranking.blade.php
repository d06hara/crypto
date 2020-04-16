@extends('layouts.layout')

@section('title', '仮想通貨トレンドランキング')
@section('keywords', '仮想通貨,仮想通貨トレンド,仮想通貨ランキング')
@section('description', '仮想通貨のトレンドが分かる！twitterから仮想通貨の銘柄ごとにツイートを集計し、ランキング形式で表示します。銘柄の絞り込み機能や、期間ごとの話題性もチェックできます。')

@section('content')
<main>
  <p class="l-main__title">仮想通貨トレンドランキング</p>
  <bland-panel></bland-panel>
</main>
@endsection