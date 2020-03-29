{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">Docs</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://blog.laravel.com">Blog</a>
                <a href="https://nova.laravel.com">Nova</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
            @auth
            <div>aaaa</div>
            @endauth

        </div>
    </div>
    <div id="app">
        <example-component></example-component>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html> --}}

@extends('layouts.layout')

@section('title', 'TOP')

@section('content')
<main>
    <div class="p-home">
        <div class="p-home__upper">
            <div class="p-home__upper-left">
                <p class="p-home__upper-left-title">crypto trend</p>
                <p class="p-home__upper-left-sub">twitterを利用した、仮想通貨の話題性を分析するツールです。</p>
            </div>
            <div class="p-home__upper-right">
                {{-- <img src="{{ asset('img/bitcoin.png') }}" alt=""> --}}
                {{-- <img src="{{ asset('img/top.png') }}" alt=""> --}}
            </div>
        </div>
        {{-- 機能紹介 --}}
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