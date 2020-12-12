<div class="alerts">
    @if (Session::has('success'))
        <div class="alert success">
            <span class="closebtn">&times;</span>
            <strong>Успех!</strong> {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert danger">
            <span class="closebtn">&times;</span>
            <strong>Ошибка!</strong> {{ Session::get('error') }}
        </div>
    @endif

    @if (Session::has('warning'))
        <div class="alert warning">
            <span class="closebtn">&times;</span>
            <strong>Предупреждение!</strong> {{ Session::get('warning') }}
        </div>
    @endif

    @if (Session::has('info'))
        <div class="alert info">
            <span class="closebtn">&times;</span>
            <strong>Информация!</strong> {{ Session::get('info') }}
        </div>
    @endif
</div>
