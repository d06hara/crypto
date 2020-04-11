<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- title, description, keyword -->
  <title>Crypto trend | @yield('title', 'Home')</title>
  <meta name="description" content="@yield('description')">
  <meta name="keywords" content="@yield('keywords')">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  {{-- fontawesome --}}
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ mix('css/style.css') }}" rel="stylesheet">
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
      <div class="c-hamburger js-toggle-sp-menu">
        <span class="c-hamburger__line"></span>
        <span class="c-hamburger__line"></span>
        <span class="c-hamburger__line"></span>
      </div>

      {{-- ナビゲーションメニュー --}}
      <nav class="c-nav js-toggle-sp-menu-target">
        <ul class="c-nav-menu">
          @guest
          <li class="c-nav-menu__item">
            <a class="c-nav-men__link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if(Route::has('register'))
          <li class="c-nav-menu__item">
            <a class="c-nav-menu__link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
          @endif
          @else
          <li class="c-nav-menu__item">
            <p class="c-nav-menu__link">ユーザー名<br><span class="c-nav-menu__link--accent">{{ Auth::user()->name }}</span>
            </p>
          </li>
          @if(Auth::user()->twitterUser)
          <li class="c-nav-menu__item">
            <p class="c-nav-menu__link">twitterアカウント<br><span
                class="c-nav-menu__link--accent">{{ Auth::user()->twitterUser->nickname }}</span></a>
          </li>
          @else
          <li class="c-nav-menu__item">
            <p class="c-nav-menu__link">twitterアカウント<br><span class="c-nav-menu__link--accent">未登録</span></p>
          </li>
          @endif
          <li class="c-nav-menu__item"><a class="c-nav-menu__link" href="{{ url("/ranking") }}">Ranking</a></li>
          <li class="c-nav-menu__item"><a class="c-nav-menu__link" href="{{ url("/account") }}">Account</a></li>
          <li class="c-nav-menu__item"><a class="c-nav-menu__link" href="{{ url("/news") }}">News</a></li>
          <li class="c-nav-menu__item">
            <a class="c-nav-menu__link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
          </li>
          @endguest
        </ul>
      </nav>

    </header>

    {{-- app --}}
    <div id="app" class="l-main js-float-menu-target">
      {{-- フラッシュメッセージ --}}
      {{-- 成功時 --}}
      @if(Session::has('flash_message'))
      <div class="c-flash" id="c-flash">
        <div class="c-flash__success">
          <p class="c-flash__success-text">{{ session('flash_message') }}</p>
        </div>
      </div>
      @endif

      {{-- 失敗時 --}}
      @if(Session::has('flash_error'))
      <div class="c-flash" id="c-flash">
        <div class="c-flash__error">
          <p class="c-flash__error-text">{{ session('flash_error') }}</p>
        </div>
      </div>
      @endif

      {{-- status --}}
      @if (session('status'))
      <div class="c-flash ">
        <div class="c-flash__status">
          <p class="c-flash__status-text">{{ session('status') }}</p>
        </div>
      </div>
      @endif
      {{-- content --}}
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
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>