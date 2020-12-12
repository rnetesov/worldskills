@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Редактировать категорию</h1>
        <form action="{{ route('admin.category.update', $category) }}" method="post">
            <label for="title"><b>Название</b></label>
            <input type="text"
               placeholder="Название" name="title" id="title" class="{{ $errors->has('title') ? 'error' : '' }}"
               value="{{ $category->title }}">
            @if ($errors->has('title'))
                <div class="error-msg">{{ $errors->first('title') }}</div>
            @endif
            <input type="submit" value="Редактировать">

            {{ method_field('patch') }}

            @csrf
        </form>
    </div>
@endsection
