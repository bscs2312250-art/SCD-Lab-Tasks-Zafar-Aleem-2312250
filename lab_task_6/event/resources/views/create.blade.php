@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
    <h2>Add New Event</h2>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <label>Title:</label><br>
        <input type="text" name="title"><br><br>

        <label>Date:</label><br>
        <input type="date" name="date"><br><br>

        <label>Location:</label><br>
        <input type="text" name="location"><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="4"></textarea><br><br>

        <button type="submit">Add Event</button>
    </form>
@endsection
