@extends('layout')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Movies</h1>
        <a href="{{ route('movies.create') }}" class="btn btn-primary">Add New Movie</a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('movies.index') }}" method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Search by title or director..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Poster</th>
                <th>Title</th>
                <th>Director</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
                <tr>
                    <td>
                        @if($movie->poster)
                            <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" class="poster-img">
                        @else
                            <span style="color: #999;">No Image</span>
                        @endif
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->director }}</td>
                    <td>{{ $movie->year }}</td>
                    <td>
                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.9em;">Edit</a>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.9em;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($movies->isEmpty())
        <p style="text-align: center; margin-top: 20px; color: #777;">No movies found.</p>
    @endif
@endsection
