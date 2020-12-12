@if(!Request::routeIs('login') && !Request::routeIs('register'))
    @if (!Auth::check())
        <div class="card">
            <h2>Вход</h2>
            <form action="{{ route('login') }}" method="post">
                <label for="login">Ваш email</label>
                <input type="text" id="login" name="login" placeholder="введите ваш логин"
                       class="{{ $errors->has('login') ? 'error' : '' }}">
                @if ($errors->has('login'))
                    <div class="error-msg">{{ $errors->first('login') }}</div>
                @endif

                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" placeholder="введите ваш пароль"
                       class="{{ $errors->has('password') ? 'error' : '' }}">
                @if ($errors->has('password'))
                    <div class="error-msg">{{ $errors->first('password') }}</div>
                @endif
                <input type="submit" value="Войти">
                @csrf
            </form>
        </div>
    @endif
@endif
