<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use App\Services\Seo\SeoContentBuilder;
use App\Services\Seo\SeoLinkService;
use App\Services\Seo\SeoUrlResolver;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoHubController extends Controller
{
    public function __construct(
        protected SeoUrlResolver $resolver,
        protected SeoContentBuilder $content,
        protected SeoLinkService $links,
    ) {}

    public function showHub(string $slug)
    {
        $resolved = $this->resolver->resolve($slug);

        abort_if(empty($resolved), 404);

        if ($redirect = $this->canonicalRedirect($slug, $resolved)) {
            return $redirect;
        }

        return $this->show(request(), $slug, $resolved);
    }

    public function showOrFallback(Request $request, string $slug)
    {
        $resolved = $this->resolver->resolve($slug);

        if (empty($resolved)) {
            return app(\App\Http\Controllers\PageController::class)->show($slug);
        }

        if ($redirect = $this->canonicalRedirect($slug, $resolved)) {
            return $redirect;
        }

        return $this->show($request, $slug, $resolved);
    }

    protected function canonicalRedirect(string $slug, array $resolved)
    {
        $canonical = $resolved['canonical_slug'] ?? $resolved['slug'];

        if ($canonical !== $slug) {
            return redirect('/'.$canonical, 301);
        }

        return null;
    }

    public function show(Request $request, string $slug, ?array $resolved = null): View
    {
        $resolved ??= $this->resolver->resolve($slug);

        abort_if(empty($resolved), 404);

        $page = $this->content->build($resolved);
        $level = $resolved['type'] === 'service' ? 'service' : $resolved['type'];
        $internalLinks = $this->links->forHub($level, $resolved);

        $view = 'seo.hubs.'.$resolved['type'];

        if (! view()->exists($view)) {
            $view = 'seo.hubs.base';
        }

        return view($view, compact('page', 'internalLinks', 'resolved'));
    }
}
