<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Requirement 6: Display all posts with Author name, Categories, Comment count
        $posts = Post::with(['user', 'categories'])->withCount('comments')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Requirement 7: Add a form to create a new post with category selection
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'categories' => 'required|array', // Requirement 7
            'categories.*' => 'exists:categories,id',
        ]);

        // Assuming basic auth or hardcoded user for now if no auth implemented yet
        // Since prompt implies "User -> Posts", I'll use the first user or auth user.
        // For simplicity in this lab setting:
        $user_id = auth()->id() ?? \App\Models\User::first()->id;

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $user_id,
        ]);

        $post->categories()->attach($request->categories);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Requirement 8: View a single post with its comments
        $post->load(['user', 'categories', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Requirement 9: feature to edit posts
        $categories = Category::all();
        $post->load('categories');
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $post->categories()->sync($request->categories);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Requirement 9: feature to delete posts
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
