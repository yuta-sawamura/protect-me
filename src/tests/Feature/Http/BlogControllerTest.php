<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testIndexWithoutSearchQuery()
    {
        $user = User::factory()->create();
        Blog::factory()->for($user)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('blogs');
    }

    public function testIndexWithSearchQuery()
    {
        $user = User::factory()->create();
        $blog1 = Blog::factory()->for($user)->create([
            'title' => 'Test title',
            'content' => 'Test content'
        ]);

        $blog2 = Blog::factory()->for($user)->create([
            'title' => 'Another title',
            'content' => 'Another content'
        ]);

        $query = 'Test';
        $response = $this->get('/?q=' . $query);

        $response->assertStatus(200);
        $response->assertViewHas('blogs');

        $this->assertTrue($response['blogs']->contains($blog1));
        $this->assertFalse($response['blogs']->contains($blog2));
    }

    public function testCreate()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('blogs.create'));

        $response->assertStatus(200);
        $response->assertViewIs('blogs.create');
    }

    public function testStore()
    {
        $data = [
            'title' => 'Test Blog Title',
            'content' => 'Test blog content',
        ];

        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('blogs.store'), $data);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('blogs', [
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $user->id,
        ]);
    }
}
