@extends('layouts.layout')

@section('title', 'ログイン')
@section('keywords', '仮想通貨,仮想通貨トレンド,仮想通貨アカウント,仮想通貨ニュース')
@section('description',
'twitterを利用した、仮想通貨の話題性を分析するツール。銘柄ごとにツイート数を集計しランキング形式で表示する仮想通貨トレンドランキング機能や,twitterから仮想通貨に関連するアカウントのみを表示する機能など、仮想通貨の話題性を分析するためのサービスです。')


@section('content')

<main>
    <div class="p-login">
        {{-- ログインフォーム --}}
        <div class="p-login__form">

            <div class="c-form">
                <p class="c-form__title"><span class="c-form__title-accent"></span>ログイン</p>

                <form action="{{ route('login') }}" method="POST" class="c-form__contents">
                    @csrf

                    <fieldset class="c-form__contents-fieldset">

                        {{-- エラーメッセージ --}}
                        <div class="c-form__contents-item">
                            <ul>
                                <li> @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </li>
                                <li>@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </li>
                            </ul>
                        </div>

                        {{-- Eメール --}}
                        <div class="c-form__contents-item">
                            <p><label for="email">Eメール</label></p>
                            <input type="email" class="use_icon @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="&#xf0e0;"></<input>
                        </div>

                        {{-- パスワード --}}
                        <div class="c-form__contents-item">
                            <p><label for="password">パスワード</label></p>
                            <input type="password" class="use_icon @error('password') is-invalid @enderror"
                                name="password" required autocomplete="password" autofocus placeholder="&#xf084;">
                            </<input>
                        </div>

                        <div><button type="submit">ログイン</button></div>

                        <p style="margin-top:10px;">パスワードを忘れた方は<a href="{{ url('password/reset') }}"
                                style="font-weight: bold;">こちら</a></p>

                    </fieldset>

                </form>
            </div>
        </div>
    </div>
</main>

@endsection