@extends('layouts.layout')

@section('content')
<main>

    <div class="p-passremind">
        <div class="c-form">

            <p class="c-form__title"><span class="c-form__title-accent"></span>パスワードリセット</p>

            <form action="{{ route('password.update') }}" method="POST" class="c-form__contents">
                @csrf

                <fieldset class="c-form__contents-fieldset">

                    {{-- email --}}
                    <div class="c-form__contents-item">
                        <p><label for="email">E-mail address</label></p>
                        <input type="email" id="email" class="use_icon @error('email') is-invalid @enderror"
                            name="email" value="{{ $mail ?? old('email') }}" required autocomplete="email" autofocus
                            placeholder="&#xf0e0;">
                        </<input>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- new-password --}}
                    <div class="c-form__contents-item">
                        <p><label for="password">password</label></p>
                        <input type="password" id="password" class="use_icon @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="&#xf084; 8文字以上で入力してください">
                        </<input>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- new-password-re --}}
                    <div class="c-form__contents-item">
                        <p><label for="password-confirm">password(再入力)</label></p>
                        <input type="password" id="password-confirm"
                            class="use_icon @error('password') is-invalid @enderror" name="password-confirmation"
                            required autocomplete="new-password" placeholder="&#xf084;">
                        </<input>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
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