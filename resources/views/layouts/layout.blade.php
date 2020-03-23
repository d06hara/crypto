<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Crypto trend | @yield('title', 'Home')</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  {{-- fontawesome --}}
  {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"> --}}
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

  {{-- header --}}
  <header class="l-header js-l-header js-float-menu">
    <a href="l-header__logo">
      <h1 class="l-header__title">crypto trend</h1>
    </a>

    <!-- ハンバーガーメニュー（スマートフォン) -->
    <div class="menu-triger js-toggle-sp-menu">
      <span></span>
      <span></span>
      <span></span>
    </div>

    {{-- ナビゲーションメニュー --}}
    <nav class="c-nav nav-menu js-toggle-sp-menu-target">
      <ul class="c-nav__menu">
        @guest
        <li class="c-nav__menu-item">
          <a class="c-nav__menu-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if(Route::has('register'))
        <li class="c-nav__menu-item">
          <a class="c-nav__menu-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="c-nav__menu-item">
          <a class="c-nav__menu-link" href="#">ユーザー名<br><span>{{ Auth::user()->name }}</span></a>
        </li>
        @if(Auth::user()->twitterUser)
        <li class="c-nav__menu-item">
          <a class="c-nav__menu-link"
            href="#">twitterアカウント<br><span>{{ Auth::user()->twitterUser->nickname }}</span></a>
        </li>
        @else
        <li class="c-nav__menu-item">
          <a class="c-nav__menu-link" href="#">twitterアカウント<br><span>未登録</span></a>
        </li>
        @endif
        <li class="c-nav__menu-item"><a class="c-nav__menu-link" href="{{ url("/ranking") }}">Ranking</a></li>
        <li class="c-nav__menu-item"><a class="c-nav__menu-link" href="{{ url("/account") }}">Account</a></li>
        <li class="c-nav__menu-item"><a class="c-nav__menu-link" href="{{ url("/news") }}">News</a></li>
        <li class="c-nav__menu-item"><a class="c-nav__menu-link" href="{{ url("/mypage") }}">Mypage</a></li>
        <li class="c-nav__menu-item">
          <a class="c-nav__menu-link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </li>
        @endguest

      </ul>
    </nav>

  </header>
  @section('sidebar')

  @show

  {{-- フラッシュメッセージ --}}
  @if(Session::has('flash_message'))
  <div class="flash_message bg-success text-center py-3 my-0">
    {{ session('flash_message') }}
  </div>
  @endif

  <div id="app" class="l-main js-float-menu-target">
    @yield('content')
  </div>

  <footer class="l-footer">
    <p class="c-footer__text">Copyright © crypto-trend. All Rights Reserved</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  {{-- <script src="/public/js/app.js"></script> --}}
  <script src="{{ asset('public/js/app.js') }}"></script>
</body>

</html>