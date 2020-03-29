@extends('layouts.layout')

@section('title', 'パスワード変更画面')

@section('content')

<main>

  {{-- form --}}
  <div class="p-login__container">
    <div class="p-login">
      <p class="p-login__title">パスワード画面</p>
      {{-- login form --}}
      <form action="{{ route('login') }}" method="POST" class="p-login__form">
        @csrf

        <fieldset class="p-login__form-fieldset">

          {{-- password --}}
          <div class="p-login__form-item">
            <p><label for="password">古いパスワード</label></p>
            <input type="password" id="password" class="use_icon @error('password') is-invalid @enderror"
              name="password" required autocomplete="password" autofocus placeholder="&#xf084; 8文字以上で入力してください">
            </<input>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          {{-- password --}}
          <div class="p-login__form-item">
            <p><label for="password">新しいパスワード</label></p>
            <input type="password" id="password" class="use_icon @error('password') is-invalid @enderror"
              name="password" required autocomplete="password" autofocus placeholder="&#xf084; 8文字以上で入力してください">
            </<input>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          {{-- password-re --}}
          <div class="p-login__form-item">
            <p><label for="password-confirmation">新しいパスワード(再入力)</label></p>
            <input type="password" id="password-confirm"
              class="use_icon @error('password-confirm') is-invalid @enderror" name="password_confirmation" required
              autocomplete="password-confirm" autofocus placeholder="&#xf084;">
            </<input>

          </div>

          <div><button type="submit">変更する</button></div>
        </fieldset>

      </form>
    </div>
  </div>


  <div class="p-mypage">
    {{-- 後でここにformを入れる --}}
    <div class="p-mypage__menu">

      <ul>
        <li><a href="{{ url('mypage') }}">マイページ</a></li>
        <li><a href="{{ url('passedit') }}">パスワード変更</a></li>
        <li><a href="{{ url('withdraw') }}">退会</a></li>
      </ul>

    </div>

  </div>


  </div>


</main>

@endsection