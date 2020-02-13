@extends('layouts.layout')

@section('title', 'アカウント一覧')

@section('content')
<main>
  <p class="l-main__title">アカウント一覧</p>
  <div class="p-account">
    @for($i=1; $i <= 5; $i++) <div class="p-account__card">
      <p>ユーザー名</p>
      <p>アカウント名</p>
      <p>フォロー数</p>
      <p>フォロワー数</p>
      <p>プロフィール</p>
      <button>フォロー</button>
      <div class="p-account__card-tweet">
        テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
      </div>
  </div>
  @endfor

  </div>


</main>
@endsection