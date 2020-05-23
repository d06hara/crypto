@extends('layouts.layout')
@section('title', '退会ページ')
@section('content')
<main>
  <div class="p-withdraw">
    {{-- 退会フォーム --}}
    <div class="p-withdraw__form">
      <div class="c-form">

        <p class="c-form__title"><span class="c-form__title-accent"></span>退会</p>

        <form action="{{ route('delete', $user->id)}}" method="POST" class="c-form__contents">
          @csrf
          <fieldset class="c-form__contents-fieldset">
            <div><button type="submit">退会する</button></div>
          </fieldset>

        </form>

      </div>
    </div>

    {{-- edit menu --}}
    <div class="p-withdtar__menu">
      <div class="c-menu">
        <ul>
          <li><a href="{{ url('mypage') }}">マイページ</a></li>
          <li><a href="{{ url('edit') }}">プロフィール編集</a></li>
          <li><a href="{{ url('passedit') }}">パスワード変更</a></li>
        </ul>

      </div>

    </div>
  </div>
</main>
@endsection