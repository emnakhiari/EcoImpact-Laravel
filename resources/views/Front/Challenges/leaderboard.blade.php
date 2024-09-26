@extends('front.layout')
<title>EcoImpact - LeaderBoard</title>

@section('content')

<div class="leaderboard-wrapper">
    <div class="leaderboard-container">
        <h1>Leaderboard</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>User</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr class="table-row @if($index == 0) winner @endif">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->score }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableBody = document.querySelector('.table tbody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));

        // Sort by score in descending order
        const sortByScore = () => {
            const sortedRows = rows.sort((a, b) => {
                const scoreA = parseInt(a.cells[2].textContent, 10);
                const scoreB = parseInt(b.cells[2].textContent, 10);
                return scoreB - scoreA; // Sort in descending order
            });
            // Re-append sorted rows
            sortedRows.forEach(row => tableBody.appendChild(row));
        };

        // Sort the leaderboard when clicking the score header
        const headerScore = document.querySelector('.table th:nth-child(3)');
        headerScore.addEventListener('click', sortByScore);
    });
</script>
<link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">

@endsection
