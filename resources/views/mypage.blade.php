@extends('layouts.layout')

@section('title', 'マイページ')

@section('content')
<main>
  <p class="l-main__title">マイページ</p>

  <div class="p-mypage">

    <div class="c-profile">
      <div class="c-profile__name">
        name:{{ $user->name }}
      </div>
      <div class="c-profile__email">
        email:{{ $user->email}}

      </div>
    </div>
  </div>


  {{-- 後でここにformを入れる --}}
  <div class="p-mypage__menu">

    <ul>
      <li><a href="{{ url('edit') }}">プロフィール編集</a></li>
      <li><a href="{{ url('passedit') }}">パスワード変更</a></li>
      <li><a href="{{ url('withdraw') }}">退会</a></li>
    </ul>

  </div>

  {{-- <my-page></my-page> --}}

</main>
@endsection