<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group exclude
 */
class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testXss()
    {
        $xssPayload = '<script>alert("xss");</script>';
        $user = User::factory()->create();
        $blog = Blog::factory()->create(['title' => $xssPayload, 'user_id' => $user->id]);
        $view = $this->view('blogs.index', ['blogs' => [$blog]]);
        $view->assertSee(e($xssPayload), false);
    }
}
