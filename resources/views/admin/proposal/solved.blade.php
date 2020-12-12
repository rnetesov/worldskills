@extends('layouts.app')

@section('content')
    <div class="card">
        <form action="{{ route('admin.proposal.solved', $proposal) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <label for="photo_after">Фото решенной проблемы</label>
            <input type="file"  class="{{ $errors->has('photo_after') ? 'error' : '' }}" name="photo_after">
            @if ($errors->has('photo_after'))
                <div class="error-msg">{{ $errors->first('photo_after') }}</div>
            @endif
            <input type="submit" value="Прикрепить">
        </form>
    </div>
@endsection
