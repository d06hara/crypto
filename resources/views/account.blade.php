@extends('layouts.layout')

@section('title', 'アカウント一覧')

@section('content')



@if(Auth::user()->twitterUser)
<main>
  <p class="l-main__title">アカウント一覧</p>

  {{-- <div class="p-account"> --}}
  {{-- @foreach($search_users as $user)
      <div class="p-account__card">
        <p>id:{{ $user->id }}</p>
  <p>name:{{ $user->name }}</p>
  <p>screen_name:{{  $user->screen_name }}</p>
  <p>friends_count:{{ $user->friends_count }}</p>
  <p>followers_count:{{ $user->followers_count }}</p>
  <p>description:{{ $user->description }}</p>

  <form action="{{ route('follow',['id' => $user->id] )}}" method="POST">
    @csrf
    <button type="submit">フォロー</button>
  </form>

  <div class="p-account__card-tweet">
    {{ $user->status->text }}
  </div>
  </div>
  @endforeach --}}

  {{-- <account-panel :twitter_accounts="{{ $twitter_accounts }}" :user_mode="{{ $user_mode }}"></account-panel> --}}
  <account-panel :user_mode="{{ $user_mode }}"></account-panel>

  {{-- </div> --}}

</main>

@else

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