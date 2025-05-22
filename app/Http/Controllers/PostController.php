<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->paginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $this->determineStatus($validated);
        $validated['user_id'] = auth()->id();

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validated();
        $this->determineStatus($data);

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    private function determineStatus(array &$data): void
    {
        if (request()->has('is_draft')) {
            $data['status'] = 'draft';
            $data['published_at'] = null;
        } else {
            $publishedAt = $data['published_at'] ?? now();
            $data['published_at'] = $publishedAt;

            $data['status'] = now()->lt($publishedAt)
                ? 'scheduled'
                : 'published';
        }
    }
}
