<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index with search functionality.
     *
     * @return void
     */
    public function testIndexSearch()
    {
        Post::factory()->create([
            'title' => 'this is a text search',
            'description' => 'Feature testing',
        ]);

        Post::factory()->create([
            'title' => 'PHP best practices',
            'description' => 'feature testing',
        ]);

        $response = $this->getJson('/api/posts?search=Laravel');

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'this is a text search'])
            ->assertJsonMissing(['title' => 'PHP Best Practices']);
    }

    /**
     * Test index without search functionality (should return all posts).
     *
     * @return void
     */
    public function testIndexWithoutSearch()
    {
        Post::factory()->count(3)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);
        $this->assertCount(3, $response->json('data'));
    }
}
