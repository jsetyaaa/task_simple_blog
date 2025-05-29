<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Automatically publish scheduled posts when their publish time arrives';

    public function handle()
    {
        Log::info('⏰ Running scheduled post publishing check...');

        $posts = Post::where('status', 'scheduled')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->get();

        if ($posts->isEmpty()) {
            Log::info('✅ No scheduled posts to publish at this time.');
        }

        foreach ($posts as $post) {
            $post->update(['status' => 'published']);
            Log::info("✅ Published post: ID {$post->id} | Title: {$post->title}");
        }

        $this->info('Scheduled post publishing command executed.');
    }
}
