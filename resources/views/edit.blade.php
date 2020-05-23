@extends('layouts.layout')

@section('title', 'プロフィール編集画面')

@section('content')
<main>

  <div class="p-edit">
    {{-- 編集フォーム --}}
    <div class="p-edit__form">
      <div class="c-form">
        <p class="c-form__title">プロフィール編集画面</p>

        <form action="{{ route('update', $user->id) }}" method="POST" class="c-form-contents">
          @csrf
          <fieldset class="c-form-contents__fieldset">
            {{-- エラーメッセージ --}}
            <div class="c-form-contents__item">
              <ul>
                <li>@error('name')
                  <span role="alert">
                    <strong class="c-form-contents__item--accent">{{ $message }}</strong>
                  </span>
                  @enderror
                </li>
                <li>@error('email')
                  <span role="alert">
                    <strong class="c-form-contents__item--accent">{{ $message }}</strong>
                  </span>
                  @enderror
                </li>
              </ul>
            </div>

            {{-- user name --}}
            <div class="c-form-contents__item">
              <p class="c-form-contents__item--label"><label for="name">ユーザーネーム</label></p>
              <input type="text" id="name" class="c-form-contents__item--form @error('name') @enderror" name="name"
                value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="&#xf007;">
              </<input>
            </div>

            {{-- email --}}
            <div class="c-form-contents__item">
              <p class="c-form-contents__item--label"><label for="email">Eメール</label></p>
              <input type="email" id="email" class="c-form-contents__item--form @error('email') @enderror" name="email"
                value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="&#xf0e0;"></<input>
            </div>

            <div><button class="c-form-contents__btn" type="submit">変更する</button></div>
          </fieldset>

        </form>
      </div>
    </div>

    {{-- edit menu --}}
    <div class="p-edit__menu">
      <div class="c-menu">

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