@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Категория</h1>
        <table id="table" style="margin-bottom: 10px; width: 80%" class="custom-table">
            <tr>
                <td>Название</td>
                <td>{{ $category->title }}</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <form action="{{ route('admin.category.destroy', $category) }}" method="post"
                          id="delete-category-form">
                        @method('delete')
                        @csrf
                        <span class="tag tag-red" data-status="delete-category">Удалить</span>
                    </form>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <span><a href="{{ route('admin.category.edit', $category) }}"
                             class="tag tag-warning">Редактировать</a></span>
                </td>
            </tr>
        </table>
    </div>
@endsection

