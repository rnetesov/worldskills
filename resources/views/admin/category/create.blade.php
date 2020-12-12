@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Создать категорию</h1>
        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">

            <label for="title"><b>Название</b></label>
            <input type="text" placeholder="Название" name="title" id="title"
                   class="{{ $errors->has('title') ? 'error' : '' }}">
            @if ($errors->has('title'))
                <div class="error-msg">{{ $errors->first('title') }}</div>
            @endif
            <input type="submit" value="Добавить">
            @csrf
        </form>
    </div>
@endsection
