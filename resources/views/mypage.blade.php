@extends('layouts.layout')

@section('title', 'マイページ')

@section('content')
<main>
  <p class="l-main__title">マイページ</p>

  <div class="p-mypage">

    {{-- profile --}}
    <div class="p-mypage__profile">
      <div class="c-profile">
        {{-- <div class="c-profile__item">
          name:<span>{{ $user->name }}</span>
      </div>
      <div class="c-profile__item">
        email:<span>{{ $user->email}}</span>
      </div> --}}
      {{-- @if(Auth::user()->twitterUser)
        <div class="c-profile__item">
          twitterアカウント:<span>{{ $twitter_account->nickname }}</span>
    </div>
    <div class="c-profile__item">
      自動フォロー:<span>
        @if($user->auto_mode === 0)
        停止中
        @else
        実行中
        @endif</span>
    </div>
    @else
    <div class="c-profile__item">
      twitterアカウント:<span>未登録</span>
    </div>
    <div class="c-profile__item">
      自動フォロー: <span>使用できません</span>
    </div>
    @endif --}}
  </div>

  </div>

  {{-- edit menu --}}
  {{-- <div class="p-mypage__menu">
    <div class="c-menu">
      <ul>
        <li><a href="{{ url('edit') }}">プロフィール編集</a></li>
  <li><a href="{{ url('passedit') }}">パスワード変更</a></li>
  <li><a href="{{ url('withdraw') }}">退会</a></li>
  </ul>
  </div>
  </div> --}}

  </div>

</main>
@endsection