<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class PostFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_posts_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $post = Post::create([
            'title' => 'Test Post',
            'body' => 'Body content',
            'user_id' => $user->id
        ]);

        $response = $this->get('/posts');
        $response->assertStatus(200);
        $response->assertSee('Test Post');
    }

    public function test_can_create_post()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Tech']);
        $this->actingAs($user);

        $response = $this->post('/posts', [
            'title' => 'New Post',
            'body' => 'New Content',
            'categories' => [$category->id]
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', ['title' => 'New Post']);
        $this->assertDatabaseHas('category_post', ['category_id' => $category->id]);
    }

    public function test_can_delete_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $post = Post::create(['title' => 'Delete Me', 'body' => 'Delete', 'user_id' => $user->id]);

        $response = $this->delete("/posts/{$post->id}");
        $response->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
