@extends('layouts.layout')
@section('title', '退会ページ')
@section('content')
<main>
  {{-- login --}}
  <div class="p-passremind__container">
    <div id="login" class="p-passremind">

      <h2 class="p-passremind__title"><span class="p-passremind__title-accent"></span>退会</h2>


      {{-- withdraw form --}}
      <form action="{{ route('delete', $user->id)}}" method="POST" class="p-passremind__form">
        @csrf
        <fieldset class="p-passremind__form-fieldset">

          <p><input type="submit" value="退会する"></<input>
          </p>


        </fieldset>

      </form>

    </div>
  </div>

  <div class="p-mypage">
    {{-- 後でここにformを入れる --}}
    <div class="p-mypage__menu">

      <ul>
        <li><a href="{{ url('mypage') }}">マイページ</a></li>
        <li><a href="{{ url('edit') }}">プロフィール編集</a></li>
        <li><a href="{{ url('passedit') }}">パスワード変更</a></li>
      </ul>

    </div>

  </div>


</main>
@endsection