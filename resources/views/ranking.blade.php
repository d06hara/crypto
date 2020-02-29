@extends('layouts.layout')

@section('title', '銘柄話題性ランキング')

@section('content')
<main>
  <p class="l-main__title">銘柄ランキング</p>
  <div class="">

    <bland-panel></bland-panel>

    {{-- チェックボックス --}}
    {{-- <div class="p-ranking__checkbox-container">
      <form class="p-ranking__checkbox">
        <p>銘柄チェックボックス</p>
        <p>TODO スクロールさせる</p>
        <label for="">
          <input type="checkbox">全て
        </label>
        <label for="">
          <input type="checkbox">ビットコイン
        </label>
        <label for="">
          <input type="checkbox">リップル
        </label>
        <label for="">
          <input type="checkbox">イーサリアム
        </label>
        <label for="">
          <input type="checkbox">ビットコインキャッシュ
        </label>
        <label for="">
          <input type="checkbox">ライトコイン
        </label>
        <label for="">
          <input type="checkbox">イーサリアムクラシック
        </label>
        <label for="">
          <input type="checkbox">リスク
        </label>

      </form>
    </div> --}}


    {{-- 銘柄一覧 --}}
    {{-- <div class="p-ranking__index-container">
      <div class="p-ranking__index">
        <h1>ここはあとでvueつかってテーブルで作る？</h1>
        <p>銘柄一覧</p>
        @foreach($data as $bland)
        <div class="p-ranking__brand-container">
          <a href="https://twitter.com/search?q={{ urlencode($bland['name']) }}&src=typed_query" target="_blank">
    <p class="p-ranking__brand"><span class="p-ranking__rank">１位</span>{{ $bland['name'] }}</p>
    <p>ツイート数:{{  $bland['count'] }}</p>
    @if($bland['name'] === 'ビットコイン')
    <p>２４時間での最高取引価格 {{ $coin_info['high'] }}</p>
    <p>２４時間での最安取引価格{{ $coin_info['low'] }}</p>
    @else
    <p>２４時間での最高取引価格 : 不明</p>
    <p>２４時間での最安取引価格 : 不明</p>
    @endif
    </a>

  </div>
  @endforeach


  </div>
  </div> --}}

  </div>


</main>

@endsection