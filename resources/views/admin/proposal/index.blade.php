@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Заявки</h1>
        @if ($all->count())
            <table id="table">
                <thead>
                <tr>
                    <th>Метка</th>
                    <th>Тема</th>
                    <th>Описание</th>
                    <th>Категория</th>
                    <th>Юзер</th>
                </tr>
                </thead>
                @foreach($proposals as $name => $items)
                    <tr>
                        @if ($items->count())
                            @if ($name == 'new')
                                <td class="proposal proposal-new" colspan="5">Новые</td>
                            @elseif($name == 'solved')
                                <td class="proposal proposal-solved" colspan="5">Выполненные</td>
                            @elseif($name == 'work')
                                <td class="proposal proposal-work" colspan="5">В работе</td>
                            @endif
                        @endif
                    </tr>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->created_at->format('Y-d-m H:i:s') }}</td>
                            <td><a href="{{ route('admin.proposal.show', $item) }}">{{ $item->title }}</a></td>
                            <td>
                                <a href="{{ route('admin.proposal.show', $item) }}">{{ mb_strimwidth($item->description, 0, 100, '...') }}</a></td>
                            <td>{{ $item->category->title }}</td>
                            <td>{{ $item->user->login }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        @endif
    </div>
@endsection
