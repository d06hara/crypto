@extends('layouts.layout')

@section('title', 'アカウント一覧')

@section('content')

<main>
  <p class="l-main__title">アカウント一覧</p>
  @auth
  <h1>ログイン状態です</h1>
  @endauth
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

  <account-panel :twitter_accounts="{{ $twitter_accounts }}" :user_mode="{{ $user_mode }}"></account-panel>

  {{-- </div> --}}

</main>




@endsection