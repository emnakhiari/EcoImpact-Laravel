@extends('back.layout')


@section('content')
    <h1>{{ $challenge->title }}</h1>
    <p>{{ $challenge->description }}</p>
    <p><strong>Start Date:</strong> {{ $challenge->start_date }}</p>
    <p><strong>End Date:</strong> {{ $challenge->end_date }}</p>
    <p><strong>Reward Points:</strong> {{ $challenge->reward_points }}</p>

    <a href="{{ route('challenges.index') }}" class="btn btn-secondary">Back to Challenges</a>
@endsection
