@extends('layouts.layout')

@section('title', '仮想通貨ニュース')
@section('keywords', '仮想通貨,仮想通貨ニュース')
@section('description', '仮想通貨に関連するのニュースをチェックできます。Googleニュースから仮想通貨というキーワードで検索したニュースを一覧で表示しています。')

@section('content')
<main>

  <p class="l-main__title">仮想通貨ニュース</p>
  <news-panel></news-panel>

</main>
@endsection