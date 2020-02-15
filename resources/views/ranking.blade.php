@extends('layouts.layout')

@section('title', '銘柄話題性ランキング')

@section('content')
<main>
  <p class="l-main__title">銘柄ランキング</p>
  <div class="p-ranking">

    {{-- チェックボックス --}}
    <div class="p-ranking__checkbox-container">
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
    </div>

    {{-- 銘柄一覧 --}}
    <div class="p-ranking__index-container">
      <div class="p-ranking__index">
        <h1>ここはあとでvueつかってテーブルで作る？</h1>
        <p>銘柄一覧</p>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">１位</span>ビットコイン(Bitcoin/BTC)</p>
          <p>ツイート数:</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">２位</span>ビットコインキャッシュ（BitcoinCash／BCH）</p>
          <p>ツイート数:</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">３位</span>イーサリアム（Ethereum／ETH）</p>
          <p>ツイート数:</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">４位</span>イーサリアムクラシック（EthereumClassic／ETC）</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">５位</span>リップル（Ripple／XRP）</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">５位</span>ライトコイン（LiteCoin／LTC）</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">６位</span>ネム（NEM／XEM）</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">６位</span>モナコイン（MonaCoin／MONA）</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">６位</span>リスク（Lisk／LSK）</p>
        </div>
        <div class="p-ranking__brand-container">
          <p class="p-ranking__brand"><span class="p-ranking__rank">６位</span>ファクトム（Factom／FCT）</p>
        </div>
      </div>
    </div>

  </div>


</main>

@endsection