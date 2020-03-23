@extends('layouts.layout')
@section('title', '退会ページ')
@section('content')
<main>
  {{-- login --}}
  <div class="p-passremind__container">
    <div id="login" class="p-passremind">

      <h2 class="p-passremind__title"><span class="p-passremind__title-accent"></span>退会</h2>


      {{-- withdraw form --}}
      <form action="#" method="POST" class="p-passremind__form">

        <fieldset class="p-passremind__form-fieldset">

          <p><input type="submit" value="退会する"></<input>
          </p>

        </fieldset>

      </form>

    </div>
  </div>


</main>
@endsection