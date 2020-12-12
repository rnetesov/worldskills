@extends('layouts.app')

@section('title', 'Мои заявки')

@section('content')
    <div class="card">
        <h1>Мои заявки</h1>
        <table id="table" style="margin-bottom: 10px" class="custom-table">
            <tr>
                <td>Метка</td>
                <td>{{ $proposal->created_at->format('Y-m-d H:i:s')}}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $proposal->description }}</td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $proposal->category->title }}</td>
            </tr>
            <tr>
                <td>Статус</td>
                <td>
                    @if($proposal->isNew())
                        <span class="tag tag-blue">новая</span>
                    @elseif($proposal->isSolved())
                        <span class="tag tag-green">решена</span>
                    @elseif($proposal->isWork())
                        <span class="tag tag-warning">в работе</span>
                    @endif
                </td>
            </tr>

            <tr>
                <td>Фото</td>
                <td>
                    <img src="{{ asset('photos/before/'.$proposal->photo_before) }}"
                         style="width: 300px; height: 200px; border: 1px solid #111; ">
                    @if($proposal->photo_after)
                        <img src="{{ asset('photos/after/'.$proposal->photo_after) }}"
                             style="width: 300px; height: 200px; border: 1px solid #111">
                    @endif
                </td>
            </tr>

            @if ($proposal->isNew())
                <tr>
                    <td></td>
                    <td>
                        <span><a href="{{ route('user.proposal.edit', $proposal) }}" class="tag tag-warning">Редактировать</a></span>
                        <form action="{{ route('user.proposal.destroy', $proposal) }}"
                              method="post" style="float: left; margin-right: 5px;", id="delete-propos-form">
                            <span data-status="delete"><a href="#" class="tag tag-red">Удалить</a></span>
                            @method('delete')
                            @csrf
                        </form>
                    </td>
                </tr>
            @endif

            @if ($proposal->isWork())
                <tr>
                    <td>Комментарий</td>
                    <td>
                        {{ $proposal->comment }}
                    </td>
                </tr>
            @endif


        </table>
        <a href="{{ route('user.proposal.index') }}" class="btn btn-blue">Мои заявки</a>
    </div>
@endsection
