<?php

namespace App\Services;

use App\Models\OurWork;
use App\Models\OurWorkVideo;
use Illuminate\Support\Collection;

class FeaturedWorkService
{
    public function items(): array
    {
        $videoCount = (int) config('featured_work.video_count', 6);
        $videos = $this->videos()->take($videoCount)->values();

        while ($videos->count() < $videoCount) {
            $fallback = config('featured_work.fallback_videos', [])[$videos->count()] ?? null;
            if (! $fallback) {
                break;
            }
            $videos->push($this->videoItem($fallback['url'], $fallback['caption']));
        }

        return $videos->all();
    }

    protected function videos(): Collection
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $urls = collect();

        if ($ourWork) {
            $urls = OurWorkVideo::query()
                ->where('our_work_id', $ourWork->id)
                ->orderBy('sort_order')
                ->pluck('youtube_url');
        }

        if ($urls->isEmpty() && ! empty($ourWork?->youtube_url)) {
            $urls = collect([$ourWork->youtube_url]);
        }

        return $urls
            ->filter()
            ->map(fn (string $url, int $index) => $this->videoItem(
                $url,
                'Studio highlight '.($index + 1).' — '.config('company.short_name')
            ));
    }

    protected function videoItem(string $url, string $caption): array
    {
        return [
            'type' => 'video',
            'watch_url' => $url,
            'embed_url' => youtube_embed_url($url),
            'thumbnail' => youtube_thumbnail_url($url),
            'caption' => $caption,
        ];
    }
}
