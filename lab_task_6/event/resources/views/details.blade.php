@extends('layouts.app')

@section('title', 'Event Details')

@section('content')
    <h2>Event Details</h2>

    @isset($event)
        <p><strong>Name:</strong> {{ $event['name'] }}</p>
        <p><strong>Date:</strong> {{ $event['date'] }}</p>
        <p><strong>Location:</strong> {{ $event['location'] }}</p>
        <p><strong>Description:</strong> {{ $event['description'] }}</p>
        <p>
            <strong>Status:</strong>
            @if($event['status'] === 'Upcoming')
                <span class="status-upcoming">{{ $event['status'] }}</span>
            @elseif($event['status'] === 'Ongoing')
                <span class="status-ongoing">{{ $event['status'] }}</span>
            @else
                <span class="status-completed">{{ $event['status'] }}</span>
            @endif
        </p>
    @endisset
@endsection
