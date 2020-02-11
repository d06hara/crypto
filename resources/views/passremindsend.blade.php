{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class="card-body">
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group row">
      <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

      <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
          value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

      <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
          name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-6 offset-md-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember"
            {{ old('remember') ? 'checked' : '' }}>

          <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
          </label>
        </div>
      </div>
    </div>

    <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary">
          {{ __('Login') }}
        </button>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
          {{ __('Forgot Your Password?') }}
        </a>
        @endif
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6 offset-md-4">
        <a href="{{ route('auth.twitter') }}">
          <button type="button" class="btn btn-primary"><i class="fab fa-twitter"></i>
            Twitterアカウントでログインする</button>
        </a>
      </div>
    </div>
  </form>
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
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">TOP</a></li>
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">MENU</a></li>
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">ABOUT</a></li>
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">NEWS</a></li>
        <li class="p-nav__menu-item"><a class="p-nav__menu-link" href="">CONTACT</a></li>
      </ul>
    </nav>

  </header>
  <div class="l-main">
    <main>
      {{-- login --}}
      <div class="p-passremind__container">
        <div id="login" class="p-passremind">

          <h2 class="p-passremind__title"><span class="p-passremind__title-accent"></span>パスコード入力</h2>


          {{-- passremind form --}}
          <form action="#" method="POST" class="p-passremind__form">

            <fieldset class="p-passremind__form-fieldset">

              <p><label for="password">パスコード</label></p>
              <p><input type="password" placeholder="パスコード"></<input>
              </p>

              <p><input type="submit" value="送信"></<input>
              </p>

            </fieldset>

          </form>

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