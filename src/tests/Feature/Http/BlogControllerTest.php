<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

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
        $this->withoutMiddleware([VerifyCsrfToken::class]);
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

    public function testEdit()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->for($user)->create();

        $response = $this->actingAs($user)->get(route('blogs.edit', $blog));

        $response->assertStatus(200);
        $response->assertViewIs('blogs.edit');
    }

    public function testUpdate()
    {
        $this->withoutMiddleware([VerifyCsrfToken::class]);
        $user = User::factory()->create();
        $blog = Blog::factory()->for($user)->create();

        $updatedData = [
            'title' => 'Updated Blog Title',
            'content' => 'Updated blog content',
        ];

        $response = $this->actingAs($user)->put(route('blogs.update', $blog), $updatedData);

        $response->assertRedirect(route('blogs.show', $blog));
        $this->assertDatabaseHas('blogs', $updatedData);
    }
}
