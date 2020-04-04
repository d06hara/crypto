@extends('layouts.layout')

@section('title', 'パスワード変更画面')

@section('content')

<main>

  <div class="p-passedit">
    {{-- パスワード変更フォーム--}}
    <div class="p-passedit__form">
      <div class="c-form">
        <p class="c-form__title">パスワード変更画面</p>

        <form action="{{ route('changepass') }}" method="POST" class="c-form__contents">
          @csrf

          <fieldset class="c-form__contents-fieldset">

            {{-- password --}}
            <div class="c-form__contents-item">
              <p><label for="old_password">現在のパスワード</label></p>
              <input type="password" id="password" class="use_icon @error('old_password') is-invalid @enderror"
                name="old_password" required autocomplete="password" autofocus placeholder="&#xf084;">
              </<input>
              @error('old_password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              {{-- パスワードが正しいかどうかのエラーメッセージは以下で表示 --}}
              @if (session('error'))
              <p class="message error">
                {{ session('error') }}
              </p>
              @endif
            </div>

            {{-- password --}}
            <div class="c-form__contents-item">
              <p><label for="new_password">新しいパスワード</label></p>
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
            <div class="c-form__contents-item">
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

    {{-- edit menu --}}
    <div class="p-passedit__menu">
      <div class="c-menu">
        <ul>
          <li><a href="{{ url('mypage') }}">マイページ</a></li>
          <li><a href="{{ url('edit') }}">プロフィール変更</a></li>
          <li><a href="{{ url('withdraw') }}">退会</a></li>
        </ul>

      </div>

    </div>


  </div>


  </div>


</main>

@endsection