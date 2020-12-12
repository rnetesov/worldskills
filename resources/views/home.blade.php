@extends('layouts.app')

@section('content')
    <div class="card">
        @foreach($proposals as $proposal)
            @if($loop->first)
                <h1>Наши работы</h1>
            @endif

            <div class="item">
                <div class="inner-item">
                    <h2>{{ $proposal->title }}</h2>
                    <h5>{{ $proposal->category->title }} {{ $proposal->created_at->format('M d, Y') }}</h5>
                    <div class="slider">
                        <div class="wrap">
                            <img src="{{ asset('photos/before/'.$proposal->photo_before) }}">
                            <img src="{{ asset('photos/after/'.$proposal->photo_after) }}">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
