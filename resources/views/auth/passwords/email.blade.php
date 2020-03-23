{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
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
    <div class="p-passremind__container">
        <div id="login" class="p-passremind">

            <p class="p-passremind__title"><span class="p-passremind__title-accent"></span>パスワードリマインダー</p>
            {{-- テンプレートにあったので後で修正して加える --}}
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif


            {{-- passremind form --}}
            <form action="{{ route('password.email') }}" method="POST" class="p-login__form">
                @csrf

                <fieldset class="p-login__form-fieldset">

                    <div class="p-login__form-item">
                        <p><label for="email">E-mail address</label></p>

                        <input id="email" type="email"
                            class="use_icon form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="&#xf0e0;">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div><button type="submit">送信</button></div>

                    </div>
                </fieldset>

            </form>

        </div>
    </div>


</main>
@endsection