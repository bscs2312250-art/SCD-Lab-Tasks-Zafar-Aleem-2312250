@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('posts.index') }}" class="btn" style="background-color: transparent; border: 1px solid var(--border);">← Back to Posts</a>
    </div>

    <div class="card">
        <h1 style="margin-bottom: 1rem;">{{ $post->title }}</h1>
        
        <div class="meta" style="font-size: 1rem; margin-bottom: 1.5rem;">
            <span>By <strong style="color: var(--primary);">{{ $post->user->name }}</strong></span> • 
            <span>{{ $post->created_at->format('F d, Y') }}</span>
        </div>

        <div style="margin-bottom: 2rem;">
            @foreach($post->categories as $category)
                <span class="badge">{{ $category->name }}</span>
            @endforeach
        </div>

        <div style="font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
            {!! nl2br(e($post->body)) !!}
        </div>

        <div style="border-top: 1px solid var(--border); padding-top: 1.5rem; margin-top: 2rem;">
            <h3>Comments ({{ $post->comments->count() }})</h3>

            @if($post->comments->isEmpty())
                <p style="color: var(--text-muted);">No comments yet.</p>
            @else
                <div style="margin-top: 1.5rem;">
                    @foreach($post->comments as $comment)
                        <div style="background-color: var(--bg); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <strong>{{ $comment->user ? $comment->user->name : 'Anonymous' }}</strong>
                                <span style="font-size: 0.875rem; color: var(--text-muted);">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <div>
                                {{ $comment->body }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
