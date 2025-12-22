@extends('layouts.app')

@section('content')
    <h2 style="margin-bottom: 1.5rem;">Latest Posts</h2>

    @foreach($posts as $post)
        <div class="card">
            <h3 style="margin-bottom: 0.5rem;">
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </h3>
            
            <div class="meta">
                <span>By {{ $post->user->name }}</span> • 
                <span>{{ $post->created_at->format('M d, Y') }}</span> •
                <span>{{ $post->comments_count }} Comments</span>
            </div>

            <div style="margin-bottom: 1rem;">
                @foreach($post->categories as $category)
                    <span class="badge">{{ $category->name }}</span>
                @endforeach
            </div>

            <div style="color: var(--text-muted); margin-bottom: 1rem;">
                {{ Str::limit($post->body, 150) }}
            </div>

            <div class="actions">
                <a href="{{ route('posts.show', $post) }}" class="btn" style="background-color: transparent; border: 1px solid var(--border);">Read More</a>
                <a href="{{ route('posts.edit', $post) }}" class="btn" style="background-color: transparent; border: 1px solid var(--border); color: var(--text-muted);">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding: 0.5rem 0.75rem;">Delete</button>
                </form>
            </div>
        </div>
    @endforeach

    @if($posts->isEmpty())
        <p style="text-align: center; color: var(--text-muted);">No posts found.</p>
    @endif
@endsection
