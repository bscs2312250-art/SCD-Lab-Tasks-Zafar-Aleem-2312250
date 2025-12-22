@extends('layout')

@section('content')
    <h1>Edit Movie</h1>
    <a href="{{ route('movies.index') }}" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to List</a>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $movie->title }}" required>
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" name="director" id="director" value="{{ $movie->director }}" required>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" name="year" id="year" value="{{ $movie->year }}" required min="1900" max="{{ date('Y') + 1 }}">
        </div>

        <div class="form-group">
            <label for="poster">Poster Image</label>
            @if($movie->poster)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $movie->poster) }}" alt="Current Poster" style="width: 100px; border-radius: 4px;">
                </div>
            @endif
            <input type="file" name="poster" id="poster" accept="image/*">
            <small style="color: #666;">Leave empty to keep current poster</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Movie</button>
    </form>
@endsection
