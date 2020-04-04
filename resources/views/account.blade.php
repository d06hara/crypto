@extends('layouts.layout')

@section('title', 'アカウント一覧')

@section('content')

{{-- twitterアカウント連携済み --}}
@if(Auth::user()->twitterUser)

<main>
  <p class="l-main__title">アカウント一覧</p>
  <account-panel :user_mode="{{ $user_mode }}"></account-panel>
</main>

@else
{{-- twitterアカウント未連携 --}}
<main>
  <div class="p-accountauth">
    <p class="p-accountauth__text">この機能を利用するにはtwitterアカウント登録が必要です。</p>
    <p class="p-accountauth__text">ご利用中のtwitterアカウントを連携する方は以下のボタンを押してください。</p>
    <div class="p-accountauth__btn">
      <a href="{{ url('/twitter') }}" class="u-twitterbtn">
        <i class="fab fa-twitter"></i><span>twitterアカウントを登録する</span>
      </a>
    </div>
  </div>

</main>

@endif




@endsection