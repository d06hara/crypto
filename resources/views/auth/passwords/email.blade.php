@extends('layouts.layout')
@section('content')
<main>


    <div class="p-passremind">

        <div class="p-passremind__form">
            <div class="c-form">

                <p class="c-form__title"><span class="c-form__title-accent"></span>パスワードリマインダー</p>

                <form action="{{ route('password.email') }}" method="POST" class="c-form__contents">
                    @csrf
                    <fieldset class="c-form__contents-fieldset">

                        {{-- エラーメッセージ --}}
                        <div class="c-form__contents-item">
                            <ul>
                                <li> @error('email')
                                    <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </li>
                            </ul>
                        </div>

                        {{-- Eメール --}}
                        <div class="c-form__contents-item">
                            <p>ご指定のEメール宛にパスワードリセット用のリンクをお送りいたします。</p>
                            <p><label for="email">Eメール</label></p>
                            <input type="email" class="use_icon form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="&#xf0e0;">

                            <div><button type="submit">送信</button></div>

                        </div>
                    </fieldset>
                </form>
            </div>
        </div>


</main>
@endsection