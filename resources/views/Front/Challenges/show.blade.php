@extends('front.layout')

@section('content')
<div class="challenge-container">
    <div class="challenge-header">
        <h1>{{ $challenge->title }}</h1>
        <div class="button-group">
            <a href="{{ route('challenges.indexfront') }}" class="btn btn-secondary back-btn">Back to Challenges</a>
            <a href="#" class="btn btn-primary add-solution-btn">Add Solution</a>
        </div>
        </div>

    <div class="challenge-content">
    <div class="image-frame">
        <img src="{{ asset('storage/' . $challenge->image) }}" alt="Challenge Image" class="img-fluid challenge-image" />
    </div>        <div class="challenge-details">
            <p><strong>Description:</strong> {{ $challenge->description }}</p>
            
            <p><strong>Start Date:</strong> {{ $challenge->start_date }}</p>
            <p><strong>End Date:</strong> {{ $challenge->end_date }}</p>
            <p><strong>Time Left:</strong> {{ $timeLeft }}</p>

            <p><strong>Reward Points:</strong> {{ $challenge->reward_points }}</p>
        </div>
    </div>

    <div class="solution-list">
        <h3>Solutions</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Solution Title</th>
                    <th>Submitted By</th>
                    <th>Submission Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Example Solution 1</td>
                    <td>Feryel Ouerfelli</td>
                    <td>2024-09-20</td>
                </tr>
                <tr>
                    <td>Example Solution 2</td>
                    <td>Feryel Ouerfelli</td>
                    <td>2024-09-21</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<link rel="stylesheet" href="{{ asset('css/challenge.css') }}">
@endsection
