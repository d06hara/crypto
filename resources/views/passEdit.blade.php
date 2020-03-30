@extends('layouts.layout')

@section('title', 'パスワード変更画面')

@section('content')

<main>

  {{-- form --}}
  <div class="p-login__container">
    <div class="p-login">
      <p class="p-login__title">パスワード画面</p>
      {{-- login form --}}
      <form action="{{ route('changepass') }}" method="POST" class="p-login__form">
        @csrf

        <fieldset class="p-login__form-fieldset">
          @if(count($errors) > 0)
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif

          {{-- password --}}
          <div class="p-login__form-item">
            <p><label for="old_password">現在のパスワード</label></p>
            <input type="password" id="password" class="use_icon @error('old_password') is-invalid @enderror"
              name="old_password" required autocomplete="password" autofocus placeholder="&#xf084;">
            </<input>
            {{-- @error('old_password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror --}}
          </div>

          {{-- password --}}
          <div class="p-login__form-item">
            <p><label for="new_password">新しいパスワード</label></p>
            <input type="password" id="password" class="use_icon @error('password') is-invalid @enderror"
              name="password" required autocomplete="password" autofocus placeholder="&#xf084; 8文字以上で入力してください">
            </<input>
            {{-- @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror --}}
          </div>

          {{-- password-re --}}
          <div class="p-login__form-item">
            <p><label for="new_password-confirmation">新しいパスワード(再入力)</label></p>
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
        <li><a href="{{ url('edit') }}">プロフィール変更</a></li>
        <li><a href="{{ url('withdraw') }}">退会</a></li>
      </ul>

    </div>

  </div>


  </div>


</main>

@endsection