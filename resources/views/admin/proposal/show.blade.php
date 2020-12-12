@extends('layouts.app')

@section('title', 'Мои заявки')

@section('content')
    <div class="card">
        <h1>Заявка</h1>
        <table id="table" style="margin-bottom: 10px" class="custom-table">
            <tr>
                <td width="120">Статус</td>
                <td>
                    @if($proposal->isNew())
                        <span class="tag  tag-blue">новая</span>
                    @elseif($proposal->isSolved())
                        <span class="tag tag-green">решена</span>
                    @elseif($proposal->isWork())
                        <span class="tag tag-warning">в работе</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Метка</td>
                <td>{{ $proposal->created_at->format('Y-m-d H:i:s')}}</td>
            </tr>
            <tr>
                <td>Юзер</td>
                <td>{{ $proposal->user->login }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $proposal->description }}</td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $proposal->category->title }}</td>
            </tr>

            @if($proposal->isNew() || $proposal->isWork())
                <tr>
                    <td>Сменить статус</td>
                    <td>
                        <form action="{{ route('admin.proposal.solved.show', $proposal) }}" method="get"
                              style="float: left; margin-right: 5px;">
                            <span class="tag  tag-green" data-status="solved">выполнено</span>
                        </form>
                        @if($proposal->isNew())
                            <form action="{{ route('admin.proposal.work.show', $proposal) }}" method="get">
                                <span class="tag tag-warning" data-status="work">принято в работу</span>
                            </form>
                        @endif
                    </td>
                </tr>
            @endif

            <tr>
                <td>Фото До</td>
                <td>
                    <img src="{{ asset('photos/before/'.$proposal->photo_before) }}"
                         style="width: 300px; height: 200px">
                </td>
            </tr>

            @if ($proposal->photo_after)
                <tr>
                    <td>Фото После</td>
                    <td>
                        <img src="{{ asset('photos/after/'.$proposal->photo_after) }}"
                             style="width: 300px; height: 200px">
                    </td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td>
                    <form action="{{ route('admin.proposal.destroy', $proposal) }}" method="post" style="float: left; margin-right: 5px;">
                        <span class="tag tag-red" data-status="work">Удалить</span>
                        @csrf
                        @method('delete')
                    </form>
                    <span data-status="work">
                        <a href="{{ route('admin.proposal.edit', $proposal) }}" class="tag tag-warning">Редактировать</a>
                    </span>
                </td>
            </tr>
        </table>
    </div>
@endsection
