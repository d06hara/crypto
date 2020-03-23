{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection --}}



@extends('layouts.layout')

@section('content')

<main>
    {{-- <p class="l-main__title">アカウントを新規登録します</p>
    <div class="p-form__container">
        <form method="POST" action="{{ route('register') }}" class="p-form p-form-register">
    @csrf --}}

    {{-- twitter --}}
    {{-- <div class="p-form__group">
                <a class="btn btn-icon btn-twitter" href="/login/twitter"><i
                        class="fab fa-twitter"></i><span>Twitterで登録</span></a>
                <p>twitterアカウントをお持ちでない方は以下から登録できます</p>
                <p>twitterアカウントを未登録の場合、本サービスの機能を一部制限させていただきます。</p>
            </div>
            @if (session('oauth_error'))
            {{ session('oauth_error') }}
    @endif --}}

    {{-- name
            <div class="p-form__group">
                <label for="name" class="c-input__label">name<span class="c-input__label-accent">必須</span></label>
                <div class="c-input__container">
                    <input type="text" class="c-input c-input__name @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>

    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div> --}}


    {{-- email
            <div class="p-form__group">
                <label for="email" class="c-input__label">email<span class="c-input__label-accent">必須</span></label>
                <div class="c-input__container">
                    <input type="text" class="c-input c-input__email @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div> --}}




    {{-- password
            <div class="p-form__group">
                <label for="password" class="c-input__label">パスワード<span class="c-input__label-accent">必須</span></label>
                <div class="c-input__container">
                    <input type="password" class="c-input c-input__password @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
    </span>
    @enderror

    </div>

    <label for="password-confirm" class="c-input__label">パスワード(再入力)<span class="c-input__label-accent">必須</span></label>
    <div class="c-input__container">
        <input type="password" class="c-input c-input_password" name="password_confirmation" required
            autocomplete="new-password">

    </div>
    </div>


    <div class="p-form__group">
        <div class="c-submit-btn__container">
            <button type="submit" class="c-submit-btn c-submit-btn__register">{{ __('Register') }}</button>
        </div>
    </div> --}}


    {{-- </form>

    </div> --}}

    {{-- register --}}
    <div class="p-login__container">
        <div id="login" class="p-login">

            <p class="p-login__title"><span class="p-login__title-accent"></span>アカウント登録</p>


            {{-- regist form --}}
            <form action="{{ route('register') }}" method="POST" class="p-login__form">
                @csrf

                <fieldset class="p-login__form-fieldset">

                    {{-- user name --}}
                    <div class="p-login__form-item">
                        <p><label for="name">user name</label></p>
                        <input type="text" id="name" class="use_icon @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="&#xf007;">
                        </<input>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- email --}}
                    <div class="p-login__form-item">
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
                    <div class="p-login__form-item">
                        <p><label for="password">password</label></p>
                        <input type="password" id="password" class="use_icon @error('password') is-invalid @enderror"
                            name="password" value="{{ old('password') }}" required autocomplete="password" autofocus
                            placeholder="&#xf084;">
                        </<input>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- password-re --}}
                    <div class="p-login__form-item">
                        <p><label for="password-confirm">password(再入力)</label></p>
                        <input type="password" id="password-confirm"
                            class="use_icon @error('password-confirm') is-invalid @enderror" name="password-confirm"
                            value="{{ old('password-confirm') }}" required autocomplete="password-confirm" autofocus
                            placeholder="&#xf084;">
                        </<input>

                    </div>

                    <p><input type="submit" value="Register"></<input>
                    </p>

                </fieldset>

            </form>

        </div>
    </div>


</main>

@endsection