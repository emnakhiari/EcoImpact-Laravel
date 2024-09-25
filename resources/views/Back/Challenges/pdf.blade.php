<!DOCTYPE html>
<html>
<head>
    <title>Challenges List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Challenges List</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reward Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach($challenges as $challenge)
                <tr>
                    <td>{{ $challenge->title }}</td>
                    <td>{{ $challenge->description }}</td>
                    <td>{{ $challenge->start_date }}</td>
                    <td>{{ $challenge->end_date }}</td>
                    <td>{{ $challenge->reward_points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
