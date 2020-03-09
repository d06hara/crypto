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
    <p class="l-main__title">アカウントを新規登録します</p>
    <div class="p-form__container">
        <form action="POST" class="p-form p-form-register">

            {{-- twitter --}}
            <div class="p-form__group">
                <a class="btn btn-icon btn-twitter" href="/login/twitter"><i
                        class="fab fa-twitter"></i><span>Twitterで登録</span></a>
                <p>twitterアカウントをお持ちでない方は以下から登録できます</p>
                <p>twitterアカウントを未登録の場合、本サービスの機能を一部制限させていただきます。</p>
            </div>
            @if (session('oauth_error'))
            {{ session('oauth_error') }}
            @endif

            {{-- name --}}
            <div class="p-form__group">
                <label for="" class="c-input__label">name<span class="c-input__label-accent">必須</span></label>
                <div class="c-input__container">
                    <input type="text" class="c-input c-input__name">

                </div>
            </div>

            {{-- email --}}
            <div class="p-form__group">
                <label for="" class="c-input__label">email<span class="c-input__label-accent">必須</span></label>
                <div class="c-input__container">
                    <input type="text" class="c-input c-input__email">

                </div>
            </div>

            {{-- password --}}
            <div class="p-form__group">
                <label for="" class="c-input__label">パスワード<span class="c-input__label-accent">必須</span></label>
                <div class="c-input__container">
                    <input type="text" class="c-input c-input__password">

                </div>

                <label for="" class="c-input__label">パスワード(再入力)<span class="c-input__label-accent">必須</span></label>
                <div class="c-input__container">
                    <input type="text" class="c-input c-input_password">

                </div>
            </div>

            <div class="p-form__group">
                <div class="c-submit-btn__container">
                    <button type="submit" class="c-submit-btn c-submit-btn__register">{{ __('Register') }}</button>
                </div>
            </div>


        </form>

    </div>

</main>

@endsection