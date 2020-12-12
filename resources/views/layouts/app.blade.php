<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @section('title') Главная
        @show
    </title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    <div class="header opacity">
        <img src="/img/logo.png" alt="">
        <h1>Студия дизайна</h1>
        <p>
            Дизайнерское оформление интерьера в нашем бюро — комплекс работ от создания концепции до инженерных систем,
            декорирования и фитодизайна. Реализуем проект под ключ.
            Укладываемся в сжатые сроки: можем вести проектирование
            одновременно со строительными работами.
            Владеем передовыми технологиями в области проектирования интерьера.
            Подбираем экологически чистые материалы.
        </p>
    </div>

    @include('includes.nav')

    <div class="row">
        <div class="leftcolumn">
            @include('includes.flash')
            @yield('content')
        </div>
        <div class="rightcolumn">
            @include('includes.blocks.login')
            <div class="card opacity">
                <h3>Галерея</h3>
                <div class="fakeimg">
                    <img src="https://i.pinimg.com/564x/56/b0/f9/56b0f92ed18fcb4c2a1816c7cd980aec.jpg" alt="">
                    <p>Фото дня</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <h2>Footer</h2>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@show

</body>
</html>



