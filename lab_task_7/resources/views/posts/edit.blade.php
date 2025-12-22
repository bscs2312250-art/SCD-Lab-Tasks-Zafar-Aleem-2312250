@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('posts.index') }}" class="btn" style="background-color: transparent; border: 1px solid var(--border);">← Back to Posts</a>
    </div>

    <div class="card">
        <h2>Edit Post: {{ $post->title }}</h2>

        @if ($errors->any())
            <div style="background-color: rgba(239, 68, 68, 0.2); color: #f87171; padding: 1rem; border-radius: 0.375rem; margin: 1rem 0;">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="form-group">
                <label for="body">Content</label>
                <textarea name="body" id="body" rows="6" required>{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="form-group">
                <label>Categories</label>
                <div class="checkbox-grid">
                    @foreach($categories as $category)
                        <div class="checkbox-item">
                            <input type="checkbox" name="categories[]" id="cat_{{ $category->id }}" value="{{ $category->id }}"
                                {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) || $post->categories->contains($category->id) ? 'checked' : '' }}>
                            <label for="cat_{{ $category->id }}" style="margin-bottom: 0; cursor: pointer;">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn">Update Post</button>
        </form>
    </div>
@endsection
