@extends('layouts.layout')

@section('title', 'パスワードリセット')
@section('keywords', '仮想通貨,仮想通貨トレンド,仮想通貨アカウント,仮想通貨ニュース')
@section('description',
'twitterを利用した、仮想通貨の話題性を分析するツール。銘柄ごとにツイート数を集計しランキング形式で表示する仮想通貨トレンドランキング機能や,twitterから仮想通貨に関連するアカウントのみを表示する機能など、仮想通貨の話題性を分析するためのサービスです。')

@section('content')
<main>
    {{-- パスワードリセットフォーム --}}
    <div class="p-passremind">
        <div class="c-form">
            {{-- フォームタイトル --}}
            <p class="c-form__title"><span class="c-form__title-accent"></span>パスワードリセット</p>
            <form action="{{ route('password.update') }}" method="POST" class="c-form-contents">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

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
                        <p><label for="email">Eメール</label></p>
                        <input type="email" id="email" class="c-form-contents__item--form @error('email') @enderror"
                            name="email" value="{{ $mail ?? old('email') }}" autocomplete="email" autofocus
                            placeholder="&#xf0e0;">
                        </<input>
                    </div>
                    {{-- 新しいパスワード --}}
                    <div class="c-form-contents__item">
                        <p><label for="password">新しいパスワード(8文字以上)</label></p>
                        <input type="password" id="password"
                            class="c-form-contents__item--form @error('password') @enderror" name="password"
                            autocomplete="new-password" placeholder="&#xf084; 8文字以上で入力してください">
                        </<input>
                    </div>
                    {{-- 新しいパスワード(確認用) --}}
                    <div class="c-form-contents__item">
                        <p><label for="password-confirmation">新しいパスワード(確認用)</label></p>
                        <input type="password" id="password-confirmation"
                            class="c-form-contents__item--form @error('password') @enderror"
                            name="password_confirmation" autocomplete="new-password-confirmation"
                            placeholder="&#xf084;">
                        </<input>
                    </div>
                    {{-- リセットボタン --}}
                    <button class="c-form-contents__btn" type="submit">パスワードをリセットする</button>
                </fieldset>
            </form>
        </div>
    </div>
</main>
@endsection