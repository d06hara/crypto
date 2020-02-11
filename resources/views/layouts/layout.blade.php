<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>crypto-trend | @yield('title', 'Home')</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('/style.css') }}" rel="stylesheet">
</head>

<body>
  @section('sidebar')
  <p>メインのサイドバー（共通部分)</p>
  @show
  <div class="main">
    @yield('content')
  </div>

  @section('footer')
  <script src="app.js"></script>
  @show
</body>

</html>