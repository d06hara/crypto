@extends('layouts.layout')

@section('title', 'パスワードリセット')
@section('keywords', '仮想通貨,仮想通貨トレンド,仮想通貨アカウント,仮想通貨ニュース')
@section('description',
'twitterを利用した、仮想通貨の話題性を分析するツール。銘柄ごとにツイート数を集計しランキング形式で表示する仮想通貨トレンドランキング機能や,twitterから仮想通貨に関連するアカウントのみを表示する機能など、仮想通貨の話題性を分析するためのサービスです。')

@section('content')
<main>

    <div class="p-passremind">
        <div class="c-form">

            <p class="c-form__title"><span class="c-form__title-accent"></span>パスワードリセット</p>

            <form action="{{ route('password.update') }}" method="POST" class="c-form-contents">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <fieldset class="c-form-contents__fieldset">

                    {{-- email --}}
                    <div class="c-form-contents__item">
                        <p><label for="email">E-mail address</label></p>
                        <input type="email" class="c-form-contents__item--form @error('email') @enderror" name="email"
                            value="{{ $mail ?? old('email') }}" required autocomplete="email" autofocus
                            placeholder="&#xf0e0;">
                        </<input>
                        @error('email')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- new-password --}}
                    <div class="c-form-contents__item">
                        <p><label for="password">password</label></p>
                        <input type="password" class="c-form-contents__item--form @error('password') @enderror"
                            name="password" required autocomplete="new-password" placeholder="&#xf084; 8文字以上で入力してください">
                        </<input>
                        @error('password')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- new-password-re --}}
                    <div class="c-form-contents__item">
                        <p><label for="password-confirm">password(再入力)</label></p>
                        <input type="password" class="c-form-contents__item--form @error('password') @enderror"
                            name="password_confirmation" required autocomplete="new-password-confirmation"
                            placeholder="&#xf084;">
                        </<input>
                        @error('password')
                        <span role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div><button type="submit">パスワードをリセットする</button></div>

                </fieldset>
            </form>
        </div>
    </div>


</main>

@endsection