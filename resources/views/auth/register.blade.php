@extends('layouts.layout')

@section('title', '新規登録')
@section('keywords', '仮想通貨,仮想通貨トレンド,仮想通貨アカウント,仮想通貨ニュース')
@section('description',
'twitterを利用した、仮想通貨の話題性を分析するツール。銘柄ごとにツイート数を集計しランキング形式で表示する仮想通貨トレンドランキング機能や,twitterから仮想通貨に関連するアカウントのみを表示する機能など、仮想通貨の話題性を分析するためのサービスです。')

@section('content')

<main>
    <div class="p-register">
        {{-- 新規登録フォーム --}}
        <div class="p-register__form">
            <div class="c-form">
                {{-- フォームタイトル --}}
                <p class="c-form__title"><span class="c-form__title-accent"></span>アカウント登録</p>
                <form action="{{ route('register') }}" method="POST" class="c-form-contents">
                    @csrf
                    <fieldset class="c-form-contents__fieldset">
                        {{-- エラーメッセージ --}}
                        <div class="c-form-contents__item">
                            <ul>
                                <li>@error('name')
                                    <span role="alert">
                                        <strong class="c-form-contents__item--accent">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </li>
                                <li> @error('email')
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
                        {{-- ユーザーネーム --}}
                        <div class="c-form-contents__item">
                            <p><label for="name">ユーザーネーム(10文字以内)</label></p>
                            <input type="text" class="c-form-contents__item--form @error('name') @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="&#xf007;">
                            </<input>
                        </div>
                        {{-- Eメール --}}
                        <div class="c-form-contents__item">
                            <p><label for="email">Eメール</label></p>
                            <input type="email" class="c-form-contents__item--form @error('email') @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="&#xf0e0;"></<input>
                        </div>
                        {{-- パスワード --}}
                        <div class="c-form-contents__item">
                            <p><label for="password">パスワード(8文字以上)</label></p>
                            <input type="password" class="c-form-contents__item--form @error('password') @enderror"
                                name="password" required autocomplete="password" autofocus placeholder="&#xf084;">
                            </<input>
                        </div>
                        {{-- パスワード(確認用) --}}
                        <div class="c-form-contents__item">
                            <p><label for="password-confirmation">パスワード(確認用)</label></p>
                            <input type="password"
                                class="c-form-contents__item--form @error('password-confirm') @enderror"
                                name="password_confirmation" required autocomplete="password-confirm" autofocus
                                placeholder="&#xf084;">
                            </<input>
                        </div>
                        {{-- 登録ボタン --}}
                        <button class="c-form-contents__btn" type="submit">登録する</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection