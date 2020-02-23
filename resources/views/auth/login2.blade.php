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
      <div class="p-login__container">
        <div id="login" class="p-login">

          {{-- twitter login --}}
          <h2 class="p-login__title"><span class="p-login__title-accent"></span>Login</h2>
          <div class="p-login__twitter">
            <a href="#" class="p-login__twitter-btn">
              <i class="fab fa-twitter"></i> <span>twitterアカウントでログインする方はこちら</span>
            </a>
          </div>

          {{-- login form --}}
          <form action="{{ route('login') }}" method="POST" class="p-login__form">
            @csrf

            <fieldset class="p-login__form-fieldset">

              <p><label for="email">E-mail address</label></p>
              <p><input type="email" id="email" placeholder="mail@address.com"></<input>
              </p>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

              <p><label for="password">Password</label></p>
              <p><input type="password" id="password" placeholder="password"></<input>
              </p>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

              <p><input type="checkbox">次回から自動でログインする</p>

              <p><input type="submit" value="Login"></<input>
              </p>
              <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
              </button>

              <p>パスワードを忘れた方は<a href="">こちら</a></p>


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