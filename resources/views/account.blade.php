{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
</div>
@endif

You are logged in!
</div>
</div>
</div>
</div>
</div>
@endsection --}}


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  {{-- fontawesome --}}
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>

<body>
  {{-- header --}}
  <header class="l-header js-l-header">
    <a href="l-header__logo">
      <h1 class="l-header__title">responsive practice</h1>
    </a>


    <!-- ハンバーガーメニュー（スマートフォン) -->
    <div class="menu-triger js-toggle-sp-menu">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <nav class="p-nav nav-menu js-toggle-sp-menu-target">
      <ul class="p-nav__menu">
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">Ranking</a></li>
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">Account</a></li>
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">News</a></li>
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">Mypage</a></li>
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">Logout</a></li>
      </ul>
    </nav>

  </header>
  <div class="l-main">
    <main>
      <p class="l-main__title">アカウント一覧</p>
      <div class="p-account">
        <div class="p-account__card">
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
        <div class="p-account__card">
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
        <div class="p-account__card">
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
        <div class="p-account__card">
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
        <div class="p-account__card">
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

      </div>


    </main>
  </div>

  <footer class="l-footer">
    <p class="c-footer__text">Copyright © crypto-trend. All Rights Reserved</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="./js/app.js"></script>
</body>

</html>