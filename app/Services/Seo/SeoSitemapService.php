<?php

namespace App\Services\Seo;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class SeoSitemapService
{
    public function __construct(
        protected SeoDataService $data,
        protected SeoUrlResolver $urls,
        protected SeoLinkService $links,
    ) {}

    public function indexXml(): string
    {
        $sitemaps = config('seo.sitemaps');
        $entries = collect($sitemaps)
            ->except('index')
            ->map(fn (string $file) => $this->sitemapEntry($file))
            ->values()
            ->all();

        return $this->wrapSitemapIndex($entries);
    }

    public function typeXml(string $type): string
    {
        $urls = match ($type) {
            'static' => $this->staticUrls(),
            'services' => $this->serviceUrls(),
            'cities' => $this->filteredUrls('city'),
            'localities' => $this->filteredUrls('locality'),
            'landmarks' => $this->filteredUrls('landmark'),
            'industries' => $this->filteredUrls('industry'),
            'pricing' => $this->filteredUrls('pricing'),
            'guides' => $this->filteredUrls('guide'),
            'blog' => $this->blogUrls(),
            default => collect(),
        };

        return $this->wrapUrlSet($urls);
    }

    public function writeAll(): void
    {
        $public = public_path();
        $sitemaps = config('seo.sitemaps');

        File::put($public.'/'.$sitemaps['index'], $this->indexXml());

        foreach ($sitemaps as $type => $file) {
            if ($type === 'index') {
                continue;
            }
            File::put($public.'/'.$file, $this->typeXml($type));
        }
    }

    protected function staticUrls(): Collection
    {
        $priority = config('seo.sitemap_priorities.hub');
        $routes = [
            route('home'),
            route('seo.locations'),
            route('seo.industries'),
            route('seo.guides'),
            route('seo.resources'),
            route('seo.directory'),
            route('seo.sitemaps'),
            route('pages.pricing'),
            route('pages.services'),
            route('pages.about'),
            route('pages.gallery'),
            route('pages.help'),
            route('pages.booking'),
            route('pages.contact'),
            route('pages.location'),
            route('pages.studio-specs'),
            route('pages.use-cases'),
            route('pages.collaborations'),
            route('pages.edit-room'),
            route('blog.index'),
        ];

        return collect($routes)->map(fn ($url) => [
            'loc' => $url,
            'priority' => $url === route('home') ? config('seo.sitemap_priorities.homepage') : $priority,
            'changefreq' => 'weekly',
        ]);
    }

    protected function serviceUrls(): Collection
    {
        return $this->data->services()->map(fn (array $service) => [
            'loc' => $this->urls->url('service', $service['slug']),
            'priority' => config('seo.sitemap_priorities.service'),
            'changefreq' => 'weekly',
        ]);
    }

    protected function filteredUrls(string $type): Collection
    {
        return $this->links->allPages()
            ->filter(fn (array $page) => $page['type'] === $type)
            ->map(fn (array $page) => [
                'loc' => $page['url'],
                'priority' => config("seo.sitemap_priorities.{$type}"),
                'changefreq' => 'monthly',
            ]);
    }

    protected function blogUrls(): Collection
    {
        if (Post::where('is_published', true)->whereNotNull('published_at')->exists()) {
            $posts = Post::where('is_published', true)
                ->whereNotNull('published_at')
                ->orderByDesc('published_at')
                ->get()
                ->map(fn (Post $post) => [
                    'loc' => route('blog.show', $post->slug),
                    'priority' => config('seo.sitemap_priorities.blog'),
                    'changefreq' => 'monthly',
                ]);

            return $posts->concat($this->categoryUrls());
        }

        return $this->data->blogs()->map(fn (array $blog) => [
            'loc' => route('blog.show', $blog['slug']),
            'priority' => config('seo.sitemap_priorities.blog'),
            'changefreq' => 'monthly',
        ]);
    }

    protected function categoryUrls(): Collection
    {
        return Category::query()
            ->whereHas('posts', fn ($query) => $query
                ->where('is_published', true)
                ->whereNotNull('published_at'))
            ->orderBy('name')
            ->get()
            ->map(fn (Category $category) => [
                'loc' => route('category.show', $category->slug),
                'priority' => config('seo.sitemap_priorities.blog'),
                'changefreq' => 'monthly',
            ]);
    }

    protected function sitemapEntry(string $file): array
    {
        return [
            'loc' => url('/'.$file),
            'lastmod' => now()->toAtomString(),
        ];
    }

    protected function wrapSitemapIndex(array $entries): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($entries as $entry) {
            $xml .= "  <sitemap>\n";
            $xml .= '    <loc>'.e($entry['loc'])."</loc>\n";
            $xml .= '    <lastmod>'.e($entry['lastmod'])."</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        $xml .= '</sitemapindex>';

        return $xml;
    }

    protected function wrapUrlSet(Collection $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.e($url['loc'])."</loc>\n";
            $xml .= '    <changefreq>'.e($url['changefreq'] ?? 'monthly')."</changefreq>\n";
            $xml .= '    <priority>'.number_format($url['priority'] ?? 0.5, 1)."</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
