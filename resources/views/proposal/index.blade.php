@extends('layouts.app')

@section('title', 'Мои заявки')

@section('content')
    <div class="card">
        <h1>Мои заявки</h1>
        @forelse($proposals as $proposal)
            @if ($loop->first)
                <div class="filter">
                    <label for="">Показать</label>
                    <select id="proposal-filter">
                        @php($url = route('user.proposal.index'))

                        <option value="{{ $url }}">Все</option>
                        <option value="{{ $url }}?sort=new"
                            {{ (Request::getUri()) == $url.'?sort=new' ? 'selected' : '' }}>
                            Новые
                        </option>
                        <option value="{{ $url }}?sort=work"
                            {{ (Request::getUri()) == $url.'?sort=work' ? 'selected' : '' }}>
                            В работе
                        </option>
                        <option value="{{ $url }}?sort=done"
                            {{ (Request::getUri()) == $url.'?sort=done' ? 'selected' : '' }}>
                            Готовые
                        </option>
                    </select>
                </div>
                <table id="table" style="margin-bottom: 10px">
                    <thead>
                    <tr>
                        <th>Метка</th>
                        <th>Названия</th>
                        <th>Описание</th>
                        <th>Категория</th>
                        <th width="100">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    @endif
                    <tr>
                        <td>{{ $proposal->created_at->format('Y-m-d H:i:s')}}</td>
                        <td><a href="{{ route('user.proposal.show', $proposal) }}">{{ $proposal->title }}</a></td>
                        <td>{{ mb_strimwidth($proposal->description, 0, 50, '...') }}</td>
                        <td>{{ $proposal->category->title }}</td>
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
                    @if ($loop->last)
                    </tbody>
                </table>
            @endif
        @empty
            <h2>Пусто</h2>
        @endforelse
        <a href="{{ route('user.proposal.create') }}" class="btn btn-blue">Новая заявка</a>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/filter.js') }}"></script>
@endsection
