@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ route('admin.proposal.update', $proposal) }}" method="post" enctype="multipart/form-data">

            <label for="login"><b>Название</b></label>
            <input type="text" placeholder="Название" name="title" id="email"
                   class="{{ $errors->has('title') ? 'error' : '' }}" value="{{ $proposal->title }}">
            @if ($errors->has('title'))
                <div class="error-msg">{{ $errors->first('title') }}</div>
            @endif

            <label for="email"><b>Выберите категорию</b></label>
            <select name="category_id" id="">
                @foreach(App\Entities\Category::all() as $category)
                    <option value="{{ $category->id }}"
                        {{ ($category->id == $proposal->category_id) ? 'selected' : '' }}>{{ $category->title }}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <div class="error-msg">{{ $errors->first('category_id') }}</div>
            @endif

            @if ($proposal->photo_after)
                <label for="photo"><b>Фото после</b></label>
                <input type="file" name="photo" id="photo" accept="image/jpeg,image/png"
                       class="{{ $errors->has('photo') ? 'error' : '' }}">
                @if ($errors->has('photo'))
                    <div class="error-msg">{{ $errors->first('photo') }}</div>
                @endif
            @endif

            <label for="email"><b>Описание</b></label>
            <textarea name="description" id="" cols="30" rows="10" class="{{ $errors->has('description') ? 'error' : '' }}">
                {{ $proposal->description }}
            </textarea>
            @if ($errors->has('description'))
                <div class="error-msg">{{ $errors->first('description') }}</div>
            @endif

            <input type="submit" value="Редактировать">

            @method('patch')

            @csrf
        </form>
    </div>
@endsection
