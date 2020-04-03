{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                    {{ __('Reset Password') }}
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
    {{-- login --}}
    <div class="p-login__container">
        <div class="c-form">

            <p class="c-form__title"><span class="c-form__title-accent"></span>パスワードリセット</p>


            {{-- passremind form --}}
            <form action="{{ route('password.update') }}" method="POST" class="c-form__contents">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

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