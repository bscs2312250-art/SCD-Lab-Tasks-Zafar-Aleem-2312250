@extends('layout')

@section('content')
    <h1>Add New Movie</h1>
    <a href="{{ route('movies.index') }}" class="btn btn-secondary" style="margin-bottom: 20px;">&larr; Back to List</a>

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" name="director" id="director" required>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" name="year" id="year" required min="1900" max="{{ date('Y') + 1 }}">
        </div>

        <div class="form-group">
            <label for="poster">Poster Image</label>
            <input type="file" name="poster" id="poster" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Save Movie</button>
    </form>
@endsection
