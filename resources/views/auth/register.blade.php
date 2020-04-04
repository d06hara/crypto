@extends('layouts.layout')

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

                        {{-- user name --}}
                        <div class="c-form__contents-item">
                            <p><label for="name">user name</label></p>
                            <input type="text" id="name" class="use_icon @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="&#xf007;">
                            </<input>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

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
                                autocomplete="password" autofocus placeholder="&#xf084; 8文字以上で入力してください">
                            </<input>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- password-re --}}
                        <div class="c-form__contents-item">
                            <p><label for="password-confirmation">password(再入力)</label></p>
                            <input type="password" id="password-confirm"
                                class="use_icon @error('password-confirm') is-invalid @enderror"
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