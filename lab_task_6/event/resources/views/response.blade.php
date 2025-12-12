@extends('layouts.app')

@section('title', 'Event Added')

@section('content')
    <h2>Event Created Successfully!</h2>

    <p><strong>Title:</strong> {{ $data['title'] }}</p>
    <p><strong>Date:</strong> {{ $data['date'] }}</p>
    <p><strong>Location:</strong> {{ $data['location'] }}</p>
    <p><strong>Description:</strong> {{ $data['description'] }}</p>
@endsection
