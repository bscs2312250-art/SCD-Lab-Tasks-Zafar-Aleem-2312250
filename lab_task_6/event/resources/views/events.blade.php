@extends('layouts.app')

@section('title', 'All Events')

@section('content')
    <h2>Upcoming Events</h2>

    @empty($events)
        <p>No events found.</p>
    @else
        <table>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
            </tr>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event['name'] }}</td>
                    <td>{{ $event['date'] }}</td>
                    <td>{{ $event['location'] }}</td>
                    <td>
                        @if($event['status'] === 'Upcoming')
                            <span class="status-upcoming">{{ $event['status'] }}</span>
                        @elseif($event['status'] === 'Ongoing')
                            <span class="status-ongoing">{{ $event['status'] }}</span>
                        @else
                            <span class="status-completed">{{ $event['status'] }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @endempty
@endsection
