@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Категории</h1>
        @foreach($categories as $category)
            @if ($loop->first)
                <table id="table" style="margin-bottom: 10px">
                    <thead>
                    <tr>
                        <th>Названия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @endif
                    <tr>
                        <td><a href="{{ route('admin.category.show', $category) }}">{{ $category->title }}</a></td>
                    </tr>

            @if($loop->last)
                    </tbody>
                </table>
            @endif
        @endforeach
        <a href="{{ route('admin.category.create') }}" class="btn btn-blue">Создать</a>
    </div>
@endsection
