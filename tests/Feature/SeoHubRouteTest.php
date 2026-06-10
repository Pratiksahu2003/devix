<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoHubRouteTest extends TestCase
{
    public function test_service_hub_routes_resolve_without_argument_errors(): void
    {
        foreach (array_keys(config('seo.service_route_names', [])) as $slug) {
            $this->get('/'.$slug)->assertOk();
        }
    }

    public function test_podcast_studio_hub_returns_seo_content(): void
    {
        $response = $this->get('/podcast-studio');

        $response->assertOk();
        $response->assertSee('Podcast', false);
    }
}
