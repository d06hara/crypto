@extends('layouts.layout')

@section('title', 'パスワードリマインダー')
@section('keywords', '仮想通貨,仮想通貨トレンド,仮想通貨アカウント,仮想通貨ニュース')
@section('description',
'twitterを利用した、仮想通貨の話題性を分析するツール。銘柄ごとにツイート数を集計しランキング形式で表示する仮想通貨トレンドランキング機能や,twitterから仮想通貨に関連するアカウントのみを表示する機能など、仮想通貨の話題性を分析するためのサービスです。')


@section('content')
<main>
    <div class="p-passremind">
        {{-- パスワードリマインダーフォーム --}}
        <div class="p-passremind__form">
            <div class="c-form">
                {{-- フォームタイトル --}}
                <p class="c-form__title"><span class="c-form__title-accent"></span>パスワードリマインダー</p>
                <form action="{{ route('password.email') }}" method="POST" class="c-form-contents">
                    @csrf
                    <fieldset class="c-form-contents__fieldset">
                        {{-- エラーメッセージ --}}
                        <div class="c-form-contents__item">
                            <ul>
                                <li> @error('email')
                                    <span role="alert">
                                        <strong class="c-form-contents__item--accent">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        {{-- Eメール --}}
                        <div class="c-form-contents__item">
                            <p style="margin-bottom:10px;">ご指定のEメール宛にパスワードリセット用のリンクをお送りいたします。</p>
                            <p class="c-form-contents__item--label"><label for="email">Eメール</label></p>
                            <input type="email" id="email"
                                class="c-form-contents__item--form @error('email')  @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email" autofocus placeholder="&#xf0e0;">
                        </div>
                        {{-- 送信ボタン --}}
                        <button class="c-form-contents__btn" type="submit">送信</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection