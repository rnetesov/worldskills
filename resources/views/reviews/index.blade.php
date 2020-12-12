@extends('layouts.app')

@section('content')
    <div class="card">
        <h1>Отзывы</h1>

        @foreach($reviews as $review)
            <div class="comment">
                <img src="{{ asset('photos/clients/'.$review->user->photo) }}" alt="">
                <b>{{ $review->user->fullname }}</b>
                <p>
                   {{ $review->comment }}
                </p>
            </div>
        @endforeach

        @if (Auth::check())
            <form action="{{ route('review.store') }}" method="post" enctype="multipart/form-data">
                <label for="comment"><b>Ваш отзыв</b></label>
                <textarea name="comment" id="" cols="30" rows="10"></textarea>
                @if ($errors->has('comment'))
                    <div class="error-msg">{{ $errors->first('comment') }}</div>
                @endif
                <input type="submit" value="Добавить">
                @csrf
            </form>
        @else
            <b>Чтобы оставить отзыв пожалуйста </b> <a href="{{ route('login') }}">авторизируйтесь</a>
        @endif
    </div>
@endsection
