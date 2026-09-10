<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Post;
use App\Support\HtmlSanitizer;
use Illuminate\Console\Command;

class SanitizeContent extends Command
{
    protected $signature = 'content:sanitize {--dry-run}';

    protected $description = 'Sanitize existing post bodies and event descriptions to remove unsafe markup.';

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');

        $this->info(($dry ? '[DRY RUN] ' : '').'Sanitizing blog posts...');

        $updated = 0;

        Post::query()
            ->select(['id', 'title', 'excerpt', 'body'])
            ->orderBy('id')
            ->each(function (Post $post) use ($dry, &$updated) {
                $clean = HtmlSanitizer::clean($post->body);

                if ($clean !== $post->body) {
                    $updated++;

                    if (! $dry) {
                        $post->timestamps = false;
                        $post->forceFill(['body' => $clean])->save();
                    }
                }
            });

        $this->info(($dry ? '[DRY RUN] ' : '')."Posts sanitized: {$updated}");

        $updated = 0;

        $this->info(($dry ? '[DRY RUN] ' : '').'Sanitizing events...');

        Event::query()
            ->select(['id', 'title', 'description'])
            ->orderBy('id')
            ->each(function (Event $event) use ($dry, &$updated) {
                $clean = HtmlSanitizer::clean($event->description);

                if ($clean !== $event->description) {
                    $updated++;

                    if (! $dry) {
                        $event->timestamps = false;
                        $event->forceFill(['description' => $clean])->save();
                    }
                }
            });

        $this->info(($dry ? '[DRY RUN] ' : '')."Events sanitized: {$updated}");

        return self::SUCCESS;
    }
}
