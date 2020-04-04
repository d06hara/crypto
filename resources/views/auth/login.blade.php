@extends('layouts.layout')

@section('title', 'ログイン')

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

                        {{-- email --}}
                        <div class="c-form__contents-item">
                            <p><label for="email">E-mail address</label></p>
                            <input type="email" id="email" class="use_icon @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="&#xf0e0;"></<input>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- password --}}
                        <div class="c-form__contents-item">
                            <p><label for="password">password</label></p>
                            <input type="password" id="password"
                                class="use_icon @error('password') is-invalid @enderror" name="password" required
                                autocomplete="password" autofocus placeholder="&#xf084;">
                            </<input>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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