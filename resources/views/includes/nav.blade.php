<div class="topnav">
    <a href="{{ route('home') }}">Главная</a>
    <a href="{{ route('reviews.index') }}">Отзывы</a>
    @if(Auth::check())

        @if (Auth::user()->isUser())
            <div class="dropdown">
                <a href="#">Мой кабинет</a>
                <div class="dropdown-content">
                    <a href="{{ route('user.proposal.index') }}">Мои заявки</a>
                    <form action="{{ route('logout') }}" method="post" id="form-logout">
                        <a href="#" onclick="document.getElementById('form-logout').submit()">Выход</a>
                        @csrf
                    </form>
                </div>
            </div>
        @endif

        @if (Auth::user()->isAdmin())
            <div class="dropdown">
                <a href="#123">Панель администратора</a>
                <div class="dropdown-content">
                    <a href="{{ route('admin.category.index') }}">Категории</a>
                    <a href="{{ route('admin.proposal.index') }}">Заявки</a>
                    <a href="{{ route('admin.user.index') }}">Пользователи</a>
                    <form action="{{ route('logout') }}" method="post" id="form-logout">
                        <a href="#" onclick="document.getElementById('form-logout').submit()">Выход</a>
                        @csrf
                    </form>
                </div>
            </div>
        @endif
    @else
        <a href="{{ route('login') }}" style="float: right">Войти</a>
        <a href="{{ route('register') }}" style="float: right">Регистрация</a>
    @endif
</div>


