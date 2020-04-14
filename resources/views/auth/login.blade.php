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
                {{-- フォームタイトル --}}
                <p class="c-form__title"><span class="c-form__title--accent"></span>ログイン</p>
                <form action="{{ route('login') }}" method="POST" class="c-form-contents">
                    @csrf
                    <fieldset class="c-form-contents__fieldset">
                        {{-- エラーメッセージ --}}
                        <div class="c-form-contents__item">
                            <ul>
                                <li>@error('email')
                                    <span role="alert">
                                        <strong class="c-form-contents__item--accent">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </li>
                                <li>@error('password')
                                    <span role="alert">
                                        <strong class="c-form-contents__item--accent">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        {{-- Eメール --}}
                        <div class="c-form-contents__item">
                            <p class="c-form-contents__item--label"><label for="email">Eメール</label></p>
                            <input type="email" id="email" class="c-form-contents__item--form @error('email') @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                                placeholder="&#xf0e0;">
                            </<input>
                        </div>
                        {{-- パスワード --}}
                        <div class="c-form-contents__item">
                            <p class="c-form-contents__item--label"><label for="password">パスワード</label></p>
                            <input type="password" id="password"
                                class="c-form-contents__item--form @error('password')  @enderror" name="password"
                                autocomplete="password" autofocus placeholder="&#xf084;">
                            </<input>
                        </div>
                        {{-- ログインボタン --}}
                        <button class="c-form-contents__btn" type="submit">ログイン</button>

                        <p class="c-form-contents__text">パスワードを忘れた方は<a href="{{ url('password/reset') }}"
                                class="c-form-contents__text--link">こちら</a></p>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection