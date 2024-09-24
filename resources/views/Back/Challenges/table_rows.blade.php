@foreach ($challenges as $challenge)
    <tr>
        <td>{{ $challenge->title }}</td>
        <td>{{ Str::limit($challenge->description, 20) }}</td>
        <td>{{ $challenge->start_date }}</td>
        <td>{{ $challenge->end_date }}</td>
        <td>{{ $challenge->reward_points }}</td>
        <td>
            <!-- Action buttons for view, edit, delete, etc. -->
        </td>
    </tr>
@endforeach
