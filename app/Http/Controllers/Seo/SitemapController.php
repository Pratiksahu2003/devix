<?php

namespace App\Http\Controllers\Seo;

use App\Http\Controllers\Controller;
use App\Services\Seo\SeoSitemapService;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __construct(
        protected SeoSitemapService $sitemaps,
    ) {}

    public function index(): Response
    {
        return $this->xml($this->sitemaps->indexXml());
    }

    public function show(string $type): Response
    {
        $file = config("seo.sitemaps.{$type}");

        abort_if(! $file, 404);

        return $this->xml($this->sitemaps->typeXml($type));
    }

    protected function xml(string $content): Response
    {
        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
