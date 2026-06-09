<?php

namespace App\Http\Controllers;

use App\Services\Seo\SeoMetaService;
use App\Services\Seo\SeoSchemaService;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the studio homepage.
     */
    public function __invoke(SeoMetaService $meta, SeoSchemaService $schema): View
    {
        $title = config('company.brand').' | Premier Podcast & Content Studio in Delhi NCR';
        $description = config('seo.defaults.site_description');
        $url = route('home');

        return view('home', [
            'seo' => [
                'meta' => $meta->buildMasterMeta($title, $description, $url),
                'schema_graph' => $schema->buildMasterGraph($title, $description, $url, [
                    ['label' => 'Home', 'url' => $url],
                ]),
            ],
            'pageTitle' => $title,
        ]);
    }
}

