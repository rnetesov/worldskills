@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ route('login') }}" method="post">
            <label for="login"><b>Логин</b></label>
            <input type="text" placeholder="Введите ваш логин" name="login" id="login"
                   class="{{ $errors->has('login') ? 'error' : '' }}">
            @if ($errors->has('login'))
                <div class="error-msg">{{ $errors->first('login') }}</div>
            @endif

            <label for="psw"><b>Пароль</b></label>
            <input type="password" placeholder="Введите ваш пароль" name="password" id="psw"
                   class="{{ $errors->has('password') ? 'error' : '' }}">
            @if ($errors->has('password'))
                <div class="error-msg">{{ $errors->first('password') }}</div>
            @endif

            <input type="submit" value="Войти">
            @csrf
        </form>
    </div>
@endsection

