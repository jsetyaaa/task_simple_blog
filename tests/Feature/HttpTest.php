<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HttpTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function homepage_dapat_diakses()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Home');
    }

    /** @test */
    public function post_index_dapat_diakses()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/posts');

        $response->assertStatus(200);
        $response->assertSee('My Own Posts');

    }

    /** @test */
    public function post_create_dapat_diakses()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/posts/create');

        $response->assertStatus(200);
        $response->assertSee('Create New Post'); // ganti sesuai view
    }

    /** @test */
    public function post_dapat_disimpan()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = Post::factory()->create([
                'user_id' => $user->id,
                'status' => 'draft',
                'published_at' => null,
            ]);

        $response = $this->post('/posts', $data->toArray());

        $response->assertStatus(302);
        $response->assertRedirect('/posts');
    }

    /** @test */
    public function post_dapat_ditampilkan()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create([
                'user_id' => $user->id,
                'status' => 'draft',
                'published_at' => null,
            ]);

        $response = $this->get('/posts/' . $post->id);
        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    /** @test */
    public function post_edit_dapat_diakses()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create([
                'user_id' => $user->id,
                'status' => 'draft',
                'published_at' => null,
            ]);

        $response = $this->get('/posts/' . $post->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    /** @test */
    public function post_dapat_diperbarui()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create([
                'user_id' => $user->id,
                'status' => 'draft',
                'published_at' => null,
            ]);

        $newData = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
            'status' => 'published',
            'published_at' => now(),
        ];

        $response = $this->put("/posts/{$post->id}", $newData);
        $response->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', $newData);
    }

    /** @test */
    public function post_dapat_dihapus()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create([
                'user_id' => $user->id,
                'status' => 'draft',
                'published_at' => null,
            ]);

        $response = $this->delete("/posts/{$post->id}");
        $response->assertRedirect('/posts');

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
