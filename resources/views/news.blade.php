@extends('layouts.layout')

@section('title', '仮想通貨ニュース')

@section('content')
<main>
  <p class="l-main__title">ニュース一覧</p>
  <div class="c-reload-btn__container">
    <a href="" class="c-reload-btn">Reload</a>
  </div>
  <div class="p-news">
    @foreach($list_gn as $news)
    <div class="p-news__card">
      <p>{{ $news['pubDate'] }}</p>
      <a href="{{ $news['url'] }}" target="_blank">
        <div class="p-news__card-tweet">
          {{ $news['title'] }}
        </div>
      </a>

      <button>お気に入り</button>

    </div>
    @endforeach
  </div>


</main>
@endsection