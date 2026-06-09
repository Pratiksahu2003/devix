<?php

namespace App\Http\Controllers\Seo\Concerns;

use App\Services\Seo\SeoMetaService;
use App\Services\Seo\SeoSchemaService;

trait BuildsMasterSeo
{
    protected function masterSeo(string $title, string $description, string $url, array $breadcrumbs): array
    {
        return [
            'meta' => app(SeoMetaService::class)->buildMasterMeta($title, $description, $url),
            'schema_graph' => app(SeoSchemaService::class)->buildMasterGraph($title, $description, $url, $breadcrumbs),
        ];
    }
}
