<?php

namespace App\Services\Blog;

use App\Services\Seo\SeoDataService;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use stdClass;

class JsonBlogService
{
    protected ?Collection $posts = null;

    public function __construct(
        protected SeoDataService $data,
        protected BlogContentBuilder $content,
    ) {}

    public function hasPosts(): bool
    {
        return $this->allPosts()->isNotEmpty();
    }

    public function paginated(?string $categorySlug = null, int $perPage = 9): LengthAwarePaginator
    {
        $items = $this->filtered($categorySlug)->values();
        $page = max(1, (int) request()->get('page', 1));
        $slice = $items->slice(($page - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $slice,
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function find(string $slug): ?stdClass
    {
        return $this->allPosts()->firstWhere('slug', $slug);
    }

    public function categories(): Collection
    {
        return $this->allPosts()
            ->pluck('category')
            ->filter()
            ->unique(fn ($cat) => $cat->slug)
            ->values();
    }

    public function categoriesWithCounts(): Collection
    {
        $counts = $this->allPosts()->countBy(fn ($post) => $post->category->slug);

        return $this->categories()->map(function ($cat) use ($counts) {
            $cat->posts_count = $counts[$cat->slug] ?? 0;

            return $cat;
        });
    }

    public function related(stdClass $post, int $limit = 5): Collection
    {
        return $this->allPosts()
            ->filter(fn ($p) => $p->slug !== $post->slug)
            ->sortByDesc(fn ($p) => ($p->category->slug ?? '') === ($post->category->slug ?? '') ? 1 : 0)
            ->take($limit)
            ->values();
    }

    public function latest(stdClass $except, int $limit = 5): Collection
    {
        return $this->allPosts()
            ->filter(fn ($p) => $p->slug !== $except->slug)
            ->take($limit)
            ->values();
    }

    public function adjacent(stdClass $post): array
    {
        $ordered = $this->allPosts()->values();
        $index = $ordered->search(fn ($p) => $p->slug === $post->slug);

        return [
            'previous' => $index > 0 ? $ordered[$index - 1] : null,
            'next' => $index !== false && $index < $ordered->count() - 1 ? $ordered[$index + 1] : null,
        ];
    }

    protected function filtered(?string $categorySlug): Collection
    {
        $posts = $this->allPosts();

        if ($categorySlug) {
            $posts = $posts->filter(fn ($p) => ($p->category->slug ?? '') === $categorySlug);
        }

        return $posts;
    }

    protected function allPosts(): Collection
    {
        if ($this->posts !== null) {
            return $this->posts;
        }

        $labels = config('seo.blog_categories', []);
        $brand = config('company.brand');

        $this->posts = $this->data->blogs()
            ->values()
            ->map(function (array $blog, int $index) use ($labels, $brand) {
                $categorySlug = $blog['category'] ?? 'creator';
                $publishedAt = isset($blog['published_at'])
                    ? Carbon::parse($blog['published_at'])
                    : Carbon::parse('2025-01-01')->addDays($index * 12);

                $post = new stdClass;
                $post->id = $index + 1;
                $post->slug = $blog['slug'];
                $post->title = $blog['title'];
                $post->excerpt = $blog['excerpt'] ?? '';
                $post->content = $blog['content'] ?? $this->content->build($blog);
                $post->cover_image = $blog['cover']
                    ?? blog_youtube_cover_url($blog)
                    ?? blog_category_cover($categorySlug);
                $post->video_url = $blog['video_url'] ?? null;
                $post->published_at = $publishedAt;
                $post->is_published = true;
                $post->meta_title = $blog['meta_title'] ?? $blog['title'].' | '.$brand.' Blog';
                $post->meta_description = $blog['meta_description'] ?? $blog['excerpt'] ?? '';
                $post->meta_keywords = $blog['meta_keywords'] ?? null;
                $post->tags = $blog['tags'] ?? [$categorySlug, 'delhi ncr', 'studio'];

                $post->category = (object) [
                    'id' => crc32($categorySlug),
                    'slug' => $categorySlug,
                    'name' => $labels[$categorySlug] ?? ucfirst($categorySlug),
                ];

                $post->author = (object) [
                    'name' => $blog['author'] ?? $brand.' Studio Team',
                ];

                $post->faqs = $blog['faqs'] ?? [];

                return $post;
            })
            ->sortByDesc('published_at')
            ->values();

        return $this->posts;
    }

    protected function defaultCover(string $category): string
    {
        return blog_category_cover($category);
    }
}
