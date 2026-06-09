<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Seo\Concerns\BuildsMasterSeo;
use App\Services\Seo\SeoDataService;
use App\Services\Seo\SeoLinkService;
use App\Services\Seo\SeoUrlResolver;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoMasterHubController extends Controller
{
    use BuildsMasterSeo;

    public function __construct(
        protected SeoDataService $data,
        protected SeoUrlResolver $urls,
        protected SeoLinkService $links,
    ) {}

    public function locations(): View
    {
        $title = 'Studio Locations in Delhi NCR | '.config('company.brand');
        $description = 'Find DyWix studio services across Delhi, Noida, Gurugram, and all NCR localities. City pages, locality hubs, and landmark coverage.';
        $seo = $this->masterSeo($title, $description, route('seo.locations'), [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Resources', 'url' => route('seo.resources')],
            ['label' => 'Locations', 'url' => route('seo.locations')],
        ]);

        return view('seo.masters.locations', [
            'services' => $this->data->services(),
            'cities' => $this->data->cities(),
            'localities' => $this->data->localities(),
            'landmarks' => $this->data->landmarks(),
            'seo' => $seo,
            'pageTitle' => $title,
        ]);
    }

    public function industries(): View
    {
        $title = 'Studio Services by Industry | '.config('company.brand');
        $description = 'Industry-specific studio services for doctors, lawyers, YouTubers, startups, e-commerce, and more at DyWix Delhi NCR.';
        $seo = $this->masterSeo($title, $description, route('seo.industries'), [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Resources', 'url' => route('seo.resources')],
            ['label' => 'Industries', 'url' => route('seo.industries')],
        ]);

        return view('seo.masters.industries', [
            'services' => $this->data->services(),
            'industries' => $this->data->industries(),
            'seo' => $seo,
            'pageTitle' => $title,
        ]);
    }

    public function guides(): View
    {
        $title = 'Studio Guides & Resources | '.config('company.brand');
        $description = 'Comprehensive guides for podcast, video production, and photography studio services across Delhi NCR.';
        $seo = $this->masterSeo($title, $description, route('seo.guides'), [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Resources', 'url' => route('seo.resources')],
            ['label' => 'Guides', 'url' => route('seo.guides')],
        ]);

        return view('seo.masters.guides', [
            'services' => $this->data->services(),
            'cities' => $this->data->cities(),
            'blogs' => $this->data->blogs(),
            'seo' => $seo,
            'pageTitle' => $title,
        ]);
    }

    public function resources(): View
    {
        $title = 'Studio Resources — SEO Hub | '.config('company.brand');
        $description = 'Master resource center for all DyWix studio services, locations, industries, guides, pricing, and blog content across Delhi NCR.';
        $seo = $this->masterSeo($title, $description, route('seo.resources'), [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Resources', 'url' => route('seo.resources')],
        ]);

        return view('seo.resources', [
            'sections' => config('seo.resource_sections'),
            'services' => $this->data->services(),
            'cities' => $this->data->cities()->take(12),
            'industries' => $this->data->industries()->take(12),
            'blogs' => $this->data->blogs(),
            'localities' => $this->data->localities()->take(12),
            'popularPages' => $this->links->allPages()->take(24),
            'seo' => $seo,
            'pageTitle' => $title,
        ]);
    }

    public function directory(Request $request): View
    {
        $perPage = config('seo.directory.per_page', 48);
        $query = strtolower(trim($request->get('q', '')));
        $type = $request->get('type', '');
        $category = $request->get('category', '');

        $all = $this->links->allPages();

        if ($query) {
            $all = $all->filter(fn ($p) => str_contains(strtolower($p['title']), $query));
        }
        if ($type) {
            $all = $all->filter(fn ($p) => $p['type'] === $type);
        }
        if ($category) {
            $all = $all->filter(fn ($p) => $p['category'] === $category);
        }

        $total = $all->count();
        $page = max(1, (int) $request->get('page', 1));
        $pages = $all->slice(($page - 1) * $perPage, $perPage)->values();
        $lastPage = max(1, (int) ceil($total / $perPage));

        $types = $this->links->allPages()->pluck('type')->unique()->sort()->values();
        $categories = $this->links->allPages()->pluck('category')->unique()->sort()->values();

        $title = 'SEO Directory — All Studio Pages | '.config('company.brand');
        $description = 'Searchable, filterable directory of all DyWix studio pages — services, cities, localities, landmarks, industries, pricing, and guides.';
        $canonical = route('seo.directory', array_filter(['q' => $query, 'type' => $type, 'category' => $category, 'page' => $page > 1 ? $page : null]));
        $seo = $this->masterSeo($title, $description, $canonical, [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Resources', 'url' => route('seo.resources')],
            ['label' => 'SEO Directory', 'url' => route('seo.directory')],
        ]);

        return view('seo.directory', compact(
            'pages', 'total', 'page', 'lastPage', 'perPage', 'query', 'type', 'category', 'types', 'categories', 'seo', 'title'
        ));
    }

    public function sitemaps(): View
    {
        $title = 'Sitemaps | '.config('company.brand');
        $description = 'XML sitemap index for all DyWix studio pages — services, cities, localities, landmarks, industries, pricing, guides, and blog.';
        $seo = $this->masterSeo($title, $description, route('seo.sitemaps'), [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Sitemaps', 'url' => route('seo.sitemaps')],
        ]);

        return view('seo.sitemaps', [
            'sitemaps' => config('seo.sitemaps'),
            'seo' => $seo,
            'pageTitle' => $title,
        ]);
    }
}
