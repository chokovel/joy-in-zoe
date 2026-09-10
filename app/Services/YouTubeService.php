<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Resolves the Joy In Zoe channel's most recent YouTube uploads.
 *
 * Priority:
 *   1. If an API key + channel id are configured, the latest uploads are
 *      fetched live from the YouTube Data API v3 and cached briefly.
 *   2. Otherwise a single manually-pinned video id (config 'youtube.video_id')
 *      is returned as a fallback so the section never looks broken.
 */
class YouTubeService
{
    /**
     * Return a list of the latest video ids from the channel.
     *
     * @return array<int, string>
     */
    public function recentVideoIds(int $limit = 3): array
    {
        $channelId = config('ministry.youtube.channel_id');
        $apiKey = config('ministry.youtube.api_key');

        if ($channelId !== '' && $apiKey !== '') {
            $ids = $this->fromApi($channelId, $apiKey, $limit);
            if ($ids !== []) {
                return $ids;
            }
        }

        $pinned = config('ministry.youtube.video_id', '');

        return $pinned !== '' ? [$pinned] : [];
    }

    /**
     * Fetch the latest uploads from a channel's "uploads" playlist.
     *
     * @return array<int, string>
     */
    protected function fromApi(string $channelId, string $apiKey, int $limit): array
    {
        $cacheKey = 'youtube.recent.'.md5($channelId);
        $minutes = max(1, (int) config('ministry.youtube.cache_minutes', 30));

        return Cache::remember($cacheKey, now()->addMinutes($minutes), function () use ($channelId, $apiKey, $limit) {
            try {
                // The uploads playlist of a channel is always "UU" + channel id.
                $playlistId = 'UU'.$channelId;

                $response = Http::timeout(8)
                    ->retry(2, 500)
                    ->get('https://www.googleapis.com/youtube/v3/playlistItems', [
                        'part' => 'snippet,contentDetails',
                        'playlistId' => $playlistId,
                        'maxResults' => min($limit, 50),
                        'key' => $apiKey,
                    ]);

                if (! $response->ok()) {
                    return [];
                }

                $ids = [];
                foreach ($response->json('items', []) as $item) {
                    $id = data_get($item, 'contentDetails.videoId');
                    if (is_string($id) && $id !== '') {
                        $ids[] = $id;
                    }
                }

                return array_slice($ids, 0, $limit);
            } catch (\Throwable $e) {
                report($e);

                return [];
            }
        });
    }
}