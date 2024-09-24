@extends('front.layout')


@section('content')
    <div class="container">
        <h1 class="h4">Available Challenges</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach ($challenges as $challenge)
                <div class="col-lg-4 mb-4">
                    <div class="card shadow">
                        <img src="{{ asset('storage/' . $challenge->image) }}" class="card-img-top" alt="{{ $challenge->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $challenge->title }}</h5>
                            <p class="card-text">{{ Str::limit($challenge->description, 100) }}</p>
                            <a href="{{ route('challenges.show', $challenge->id) }}" class="btn btn-primary">View Challenge</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
