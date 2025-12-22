<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Movie;

class MovieCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_movie_crud_flow()
    {
        Storage::fake('public');

        // 1. Create Movie with Image
        $file = UploadedFile::fake()->create('poster.jpg');

        $response = $this->post(route('movies.store'), [
            'title' => 'Inception',
            'director' => 'Christopher Nolan',
            'year' => 2010,
            'poster' => $file,
        ]);

        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseHas('movies', ['title' => 'Inception']);
        
        $movie = Movie::first();
        Storage::disk('public')->assertExists($movie->poster);

        // 2. Read (Index)
        $response = $this->get(route('movies.index'));
        $response->assertSee('Inception');
        $response->assertSee('Christopher Nolan');

        // 3. Search
        $response = $this->get(route('movies.index', ['search' => 'Nolan']));
        $response->assertSee('Inception');

        $response = $this->get(route('movies.index', ['search' => 'Spielberg']));
        $response->assertDontSee('Inception');

        // 4. Update
        $newFile = UploadedFile::fake()->create('new_poster.jpg');
        $oldPoster = $movie->poster;

        $response = $this->put(route('movies.update', $movie->id), [
            'title' => 'Inception Edited',
            'director' => 'C. Nolan',
            'year' => 2010,
            'poster' => $newFile,
        ]);

        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseHas('movies', ['title' => 'Inception Edited']);
        
        $movie->refresh();
        Storage::disk('public')->assertExists($movie->poster);
        Storage::disk('public')->assertMissing($oldPoster); // Ensure old file deleted

        // 5. Delete
        $posterToDelete = $movie->poster;

        $response = $this->delete(route('movies.destroy', $movie->id));
        $response->assertRedirect(route('movies.index'));
        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
        Storage::disk('public')->assertMissing($posterToDelete);
    }
}
