<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShow()
    {
        $user = User::factory()->create();
        Blog::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->get(route('users.show', $user));

        $response->assertStatus(200);
        $response->assertViewHas('user');
        $response->assertViewHas('blogs');
    }

    public function testEdit()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('users.edit', $user));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
    }

    public function testUpdate()
    {
        $this->withoutMiddleware([VerifyCsrfToken::class]);
        $user = User::factory()->create();
        $this->actingAs($user);

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->put(route('users.update', $user), $updatedData);

        $response->assertRedirect(route('users.show', $user));
        $this->assertDatabaseHas('users', $updatedData);
    }

    public function testDestroy()
    {
        $this->withoutMiddleware([VerifyCsrfToken::class]);
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->delete(route('users.destroy', $user));

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
