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

                <p class="c-form__title"><span class="c-form__title-accent"></span>アカウント登録</p>

                <form action="{{ route('register') }}" method="POST" class="c-form__contents">
                    @csrf

                    <fieldset class="c-form__contents-fieldset">

                        {{-- エラーメッセージ --}}
                        <div class="c-form__contents-item">
                            <ul>
                                <li>@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </li>
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


                        {{-- ユーザーネーム --}}
                        <div class="c-form__contents-item">
                            <p><label for="name">ユーザーネーム(10文字以内)</label></p>
                            <input type="text" class="use_icon @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="&#xf007;">
                            </<input>
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
                                name="password" required autocomplete="password" autofocus
                                placeholder="&#xf084; 8文字以上で入力してください">
                            </<input>
                        </div>

                        {{-- パスワード(確認用) --}}
                        <div class="c-form__contents-item">
                            <p><label for="password-confirmation">パスワード(確認用)</label></p>
                            <input type="password" class="use_icon @error('password-confirm') is-invalid @enderror"
                                name="password_confirmation" required autocomplete="password-confirm" autofocus
                                placeholder="&#xf084;">
                            </<input>

                        </div>

                        <div>
                            <button type="submit">登録する</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection