<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    // 1. List Movies (Read) + Search
    public function index(Request $request)
    {
        $query = Movie::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('director', 'like', "%{$search}%");
        }

        $movies = $query->latest()->get();

        return view('movies.index', compact('movies'));
    }

    // 2. Show Create Form
    public function create()
    {
        return view('movies.create');
    }

    // 3. Store Movie (Create) + File Upload
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'year' => $request->year,
            'poster' => $posterPath,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    // 4. Show Edit Form
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    // 5. Update Movie (Update) + File Replacement
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'year' => 'required|integer',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $movie = Movie::findOrFail($id);
        $data = $request->only(['title', 'director', 'year']);

        if ($request->hasFile('poster')) {
            // Delete old poster if exists
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    // 6. Delete Movie (Delete) + File Deletion
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->poster) {
            Storage::disk('public')->delete($movie->poster);
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
