<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Crypto trend | @yield('title', 'Home')</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  {{-- fontawesome --}}
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
  <div class="l-wrapper">

    {{-- ヘッダー --}}
    <header class="l-header js-l-header js-float-menu">
      @if(Auth::user())
      <a href="{{ route('ranking') }}" class="l-header__logo">
        <h1 class="l-header__title">crypto trend</h1>
      </a>
      @else
      <a href="{{ route('/') }}" class="l-header__logo">
        <h1 class="l-header__title">crypto trend</h1>
      </a>
      @endif

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
            <p class="c-nav__menu-link">ユーザー名<br><span>{{ Auth::user()->name }}</span></p>
          </li>
          @if(Auth::user()->twitterUser)
          <li class="c-nav__menu-item">
            <p class="c-nav__menu-link">twitterアカウント<br><span>{{ Auth::user()->twitterUser->nickname }}</span></a>
          </li>
          @else
          <li class="c-nav__menu-item">
            <p class="c-nav__menu-link">twitterアカウント<br><span>未登録</span></p>
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


    <div id="app" class="l-main js-float-menu-target">
      {{-- フラッシュメッセージ --}}
      {{-- 成功時 --}}
      @if(Session::has('flash_message'))
      <div class="c-flash ">
        <div class="c-flash__success">
          <p class="c-flash__success-text">{{ session('flash_message') }}</p>
        </div>
      </div>
      @endif

      {{-- 失敗時 --}}
      @if(Session::has('flash_error'))
      <div class="c-flash">
        <div class="c-flash__error">
          <p class="c-flash__error-text">{{ session('flash_error') }}</p>
        </div>
      </div>
      @endif
      @yield('content')
    </div>

    {{-- footer --}}
    <footer class="l-footer">
      <p class="c-footer__text">Copyright © crypto-trend. All Rights Reserved</p>
    </footer>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  {{-- <script src="/public/js/app.js"></script> --}}
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>