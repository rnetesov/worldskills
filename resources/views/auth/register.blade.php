@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 style="padding: 10px 0">Регистрация</h2>
        <hr style="margin-bottom: 10px">

        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
            <label for="login"><b>Логин</b></label>
            <input type="text" placeholder="Введите ваш логин" name="login" id="login"
                   class="{{ $errors->has('login') ? 'error' : '' }}"
                   value="{{ old('login') }}">
            @if ($errors->has('login'))
                <div class="error-msg">{{ $errors->first('login') }}</div>
            @endif

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Введите ваш email" name="email" id="email"
                   class="{{ $errors->has('email') ? 'error' : '' }}"
                   value="{{ old('email') }}">
            @if ($errors->has('email'))
                <div class="error-msg">{{ $errors->first('email') }}</div>
            @endif

            <label for="fullname"><b>Полное имя ваше Ф.И.O</b></label>
            <input type="text" placeholder="Введите ваш полное имя фамилия и отчество через пробел" name="fullname" id="email"
                   class="{{ $errors->has('fullname') ? 'error' : '' }}"
                   value="{{ old('fullname') }}">
            @if ($errors->has('full_name'))
                <div class="error-msg">{{ $errors->first('full_name') }}</div>
            @endif


            <label for=""><b>Ваше фото</b></label>
            <input type="file" name="photo"  class="{{ $errors->has('photo') ? 'error' : '' }}">
            @if ($errors->has('photo'))
                <div class="error-msg">{{ $errors->first('photo') }}</div>
            @endif

            <label for="psw"><b>Пароль</b></label>
            <input type="password" placeholder="Введите ваш пароль" name="password" id="psw"
                   class="{{ $errors->has('password') ? 'error' : '' }}">
            @if ($errors->has('password'))
                <div class="error-msg">{{ $errors->first('password') }}</div>
            @endif

            <label for="password_confirmation"><b>Повторите пароль</b></label>
            <input type="password" placeholder="Введите ваш пароль" name="password_confirmation" id="password_confirmation">

            <input type="checkbox" id="confirm" name="confirm">
            <label for="confirm">Я согласен на обработку персональных данных</label>
            @if ($errors->has('confirm'))
                <div class="error-msg">{{ $errors->first('confirm') }}</div>
            @endif

            <input type="submit" value="Зерегестрировать">

            @csrf
        </form>
    </div>
@endsection
