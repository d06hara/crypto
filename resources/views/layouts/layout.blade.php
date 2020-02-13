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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

  <!-- Styles -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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


  @section('sidebar')
  <p>メインのサイドバー（共通部分)</p>
  @show
  <div class="l-main">
    @yield('content')
  </div>

  <footer class="l-footer">
    <p class="c-footer__text">Copyright © crypto-trend. All Rights Reserved</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="./js/app.js"></script>
</body>

</html>