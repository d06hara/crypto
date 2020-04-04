@extends('layouts.layout')

@section('title', 'TOP')

@section('content')
<main>
    <div class="p-home">

        {{-- topページ上部 --}}
        <div class="p-home__upper">
            {{-- 紹介 --}}
            <div class="p-home__upper-left">
                <p class="p-home__upper-left-title">crypto trend</p>
                <p class="p-home__upper-left-sub">twitterを利用した、仮想通貨の話題性を分析するツールです。</p>
            </div>
            {{-- 画像 --}}
            <div class="p-home__upper-right">
            </div>
        </div>

        {{-- topページ下部 --}}
        <div class="p-home__bottom">
            <div class="p-home__bottom-contents">
                <p class="p-home__bottom-contents-heading">機能紹介</p>

                <div class="c-introduction">
                    <p class="c-introduction__function">機能１:仮想通貨トレンドランキング</p>
                    <p class="c-introduction__content">&check;銘柄ごとにツイート数を集計し、各銘柄の話題性を教えてくれます。</p>
                </div>

                <div class="c-introduction">
                    <p class="c-introduction__function">機能２:仮想通貨アカウント表示機能</p>
                    <p class="c-introduction__content">
                        &check;twitterアカウントをサービスに連携することで、サービス内から仮想通貨関連アカウントのフォローが可能です。
                    </p>
                    <p class="c-introduction__content">
                        &check;仮想通貨アカウントのフォローを自動で行うことができます。
                    </p>
                </div>

                <div class="c-introduction">
                    <p class="c-introduction__function">機能３:仮想通貨関連ニュース表示機能</p>
                    <p class="c-introduction__content">&check;Google newsの仮想通貨に関するニュースをチェックできます。</p>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection