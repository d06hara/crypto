{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                    name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <a href="{{ route('auth.twitter') }}">
                    <button type="button" class="btn btn-primary"><i class="fab fa-twitter"></i>
                        Twitterアカウントでログインする</button>
                </a>
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

@section('title', 'ログイン')

@section('content')

<main>
    <div class="p-login">
        <div class="p-login__form">
            <div class="c-form">

                <p class="c-form__title"><span class="c-form__title-accent"></span>ログイン</p>


                {{-- login form --}}
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