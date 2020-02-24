@extends('layouts.layout')

@section('title', 'アカウント一覧')

@section('content')
<main>
  <p class="l-main__title">アカウント一覧</p>
  <div class="p-account">
    @foreach($search_users as $user)
    <div class="p-account__card">
      <p>id:{{ $user->id }}</p>
      <p>name:{{ $user->name }}</p>
      <p>screen_name:{{  $user->screen_name }}</p>
      <p>friends_count:{{ $user->friends_count }}</p>
      <p>followers_count:{{ $user->followers_count }}</p>
      <p>description:{{ $user->description }}</p>
      <button>フォロー</button>
      <div class="p-account__card-tweet">
        {{ $user->status->text }}
      </div>
    </div>
    @endforeach

  </div>


</main>
@endsection