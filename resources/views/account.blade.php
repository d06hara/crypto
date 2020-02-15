@extends('layouts.layout')

@section('title', 'アカウント一覧')

@section('content')
<main>
  <p class="l-main__title">アカウント一覧</p>
  <div class="p-account">
    @foreach($search_users as $user)
    <div class="p-account__card">
      <p>{{ $user->name }}</p>
      <p>{{  $user->screen_name }}</p>
      <p>{{ $user->friends_count }}</p>
      <p>{{ $user->followers_count }}</p>
      <p>{{ $user->description }}</p>
      <button>フォロー</button>
      <div class="p-account__card-tweet">
        {{ $user->status->text }}
      </div>
    </div>
    @endforeach

  </div>


</main>
@endsection