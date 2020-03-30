@extends('layouts.layout')

@section('title', 'プロフィール編集画面')

@section('content')
<main>

  {{-- form --}}
  <div class="p-login__container">
    <div class="p-login">
      <p class="p-login__title">プロフィール編集画面</p>
      {{-- login form --}}
      <form action="{{ route('update', $user->id) }}" method="POST" class="p-login__form">
        @csrf

        <fieldset class="p-login__form-fieldset">

          {{-- user name --}}
          <div class="p-login__form-item">
            <p><label for="name">user name</label></p>
            <input type="text" id="name" class="use_icon @error('name') is-invalid @enderror" name="name"
              value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="&#xf007;">
            </<input>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          {{-- email --}}
          <div class="p-login__form-item">
            <p><label for="email">E-mail</label></p>
            <input type="email" id="email" class="use_icon @error('email') is-invalid @enderror" name="email"
              value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="&#xf0e0;"></<input>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
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





</main>
@endsection