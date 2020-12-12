@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ route('admin.proposal.work', $proposal) }}" method="post">
            @csrf
            @method('patch')
            <label for="comment">Укажите ваш комментарий</label>
            <textarea name="comment" id="comment" cols="30" rows="10">
                {{ old('comment') }}
            </textarea>
            @if ($errors->has('comment'))
                <div class="error-msg">{{ $errors->first('comment') }}</div>
            @endif
            <input type="submit" value="Изменить">
        </form>
    </div>
@endsection
