@extends('layouts.app')

@section('title', 'Добавить заявку')

@section('content')
    <div class="card">
        <h1>Новая заявка</h1>

        <form action="{{ route('user.proposal.store') }}" method="post" enctype="multipart/form-data">

            <label for="title"><b>Название</b></label>
            <input type="text" placeholder="Название" name="title" id="title"
                   class="{{ $errors->has('title') ? 'error' : '' }}" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <div class="error-msg">{{ $errors->first('title') }}</div>
            @endif

            <label for="photo"><b>Фото</b></label>
            <input type="file" name="photo" id="photo" accept="image/jpeg,image/png"
                   class="{{ $errors->has('photo') ? 'error' : '' }}">
            @if ($errors->has('photo'))
                <div class="error-msg">{{ $errors->first('photo') }}</div>
            @endif

            <label for="category_id"><b>Выберите категорию</b></label>
            <select name="category_id" id="">
                @foreach(App\Entities\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <div class="error-msg">{{ $errors->first('category_id') }}</div>
            @endif

            <label for="description"><b>Описание</b></label>
            <textarea name="description" id="description" cols="30" rows="10" class="{{ $errors->has('description') ? 'error' : '' }}">
                {{ old('description') }}
            </textarea>
            @if ($errors->has('description'))
                <div class="error-msg">{{ $errors->first('description') }}</div>
            @endif

            <input type="submit" value="Добавить">

            @csrf
        </form>
    </div>
@endsection
