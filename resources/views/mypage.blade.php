@extends('layouts.layout')

@section('title', 'マイページ')

@section('content')
<main>
  <p class="l-main__title">マイページ</p>
  <div class="p-mypage">

    {{-- 左コンテンツ --}}
    <div class="p-mypage__left">
      {{-- 左：マイ銘柄 --}}
      <div class="p-mybrand">
        <p class="p-mybrand__title">マイ銘柄</p>
        <div class="p-mybrand__card-container">
          <div class="p-mybrand__card p-ranking__brand-container">
            <p class="p-mybrand__card-name">ビットコイン</p>
          </div>
          <div class="p-mybrand__card p-ranking__brand-container">
            <p class="p-mybrand__card-name">リップル</p>
          </div>
          <div class="p-mybrand__card p-ranking__brand-container">
            <p class="p-mybrand__card-name">＋</p>
          </div>
        </div>


      </div>
      {{-- 左：マイニュース --}}
      <div class="p-mynews">
        <p class="p-mynews__title">マイニュース</p>
        <div class="p-mynews__container">
          <div class="p-news__card">
            <p>ニュース名</p>
            <div class="p-news__card-tweet">
              テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
            </div>
            <button>お気に入り</button>

          </div>
          <div class="p-news__card">
            <p>ニュース名</p>
            <div class="p-news__card-tweet">
              テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
            </div>
            <button>お気に入り</button>

          </div>
          <div class="p-news__card">
            <p>ニュース名</p>
            <div class="p-news__card-tweet">
              テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
            </div>
            <button>お気に入り</button>

          </div>

        </div>

      </div>

    </div>

    {{-- 右コンテンツ --}}
    <div class="p-mypage__right">
      <div class="p-mypage__menu">
        <ul>
          <li><a href="">プロフィール編集</a></li>
          <li><a href="">パスワード変更</a></li>
          <li><a href="">退会</a></li>
        </ul>
      </div>

    </div>


  </div>


</main>
@endsection