<?php

namespace App\Http\Controllers;

use App\Services\SeoPageRepository;
use App\Services\SeoSchemaGenerator;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeoPageController extends Controller
{
    public function __construct(
        protected SeoPageRepository $repository,
        protected SeoSchemaGenerator $schemaGenerator
    ) {}

    /**
     * Display the specified programmatic SEO landing page.
     *
     * @param string $slug
     * @return View|\Illuminate\Http\RedirectResponse
     */
    public function show(string $slug)
    {
        // 1. Fetch page from repository
        $page = $this->repository->getPageBySlug($slug);

        if (!$page) {
            // Fallback to legacy database PageController if possible, otherwise abort 404
            try {
                return app(\App\Http\Controllers\PageController::class)->show($slug);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                abort(404, 'Page not found');
            } catch (\Throwable $th) {
                abort(404, 'Page not found');
            }
        }

        // 2. Fetch related details
        $service = $this->repository->getServiceById($page['service_id']);
        $location = $this->repository->getLocationById($page['location_id']);

        // 3. Generate schema structures
        $schema = $this->schemaGenerator->generate($page, $service, $location);

        // 4. Determine robots content
        $robots = ($page['indexable'] ?? true) ? 'index, follow' : 'noindex, follow';

        // 5. Canonical mapping
        $canonical = $page['canonical_url'] ?? (config('dywix.base_url', 'https://www.dywix.com') . '/' . $slug);

        // 6. Build Open Graph & Twitter parameters
        $meta = [
            'title' => $page['seo_title'],
            'description' => $page['meta_description'],
            'robots' => $robots,
            'canonical' => $canonical,
            'og_image' => config('dywix.base_url') . config('dywix.default_image'),
            'og_url' => $canonical
        ];

        // 7. Select appropriate template
        $template = 'seo.landing-page';
        if (($page['page_type'] ?? '') === 'main-service-page') {
            $template = 'seo.service-page';
        } elseif (($page['page_type'] ?? '') === 'location-page') {
            $template = 'seo.location-page';
        }

        // Fallback to landing-page if specific view does not exist
        if (!view()->exists($template)) {
            $template = 'seo.landing-page';
        }

        return view($template, compact('page', 'service', 'location', 'schema', 'meta'));
    }
}
