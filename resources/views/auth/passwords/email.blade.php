@extends('layouts.layout')
@section('content')
<main>


    <div class="p-passremind">

        @if (session('status'))
        <div class="c-flash">
            <div class="c-flash__success" role="alert">
                {{ session('status') }}
            </div>
        </div>
        @endif

        <div class="p-passremind__form">
            <div class="c-form">

                <p class="c-form__title"><span class="c-form__title-accent"></span>パスワードリマインダー</p>

                <form action="{{ route('password.email') }}" method="POST" class="c-form__contents">
                    @csrf
                    <fieldset class="c-form__contents-fieldset">
                        <div class="c-form__contents-item">
                            <p><label for="email">E-mail address</label></p>

                            <input id="email" type="email"
                                class="use_icon form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="&#xf0e0;">
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