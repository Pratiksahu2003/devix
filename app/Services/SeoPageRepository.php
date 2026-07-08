<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SeoPageRepository
{
    protected string $storagePath = 'seo/';

    /**
     * Get all generated pages, either from cache or raw JSON.
     *
     * @return array
     */
    public function getAllPages(): array
    {
        return Cache::remember('seo_pages_all', 86400, function () {
            return $this->loadJsonFile('pages.json');
        });
    }

    /**
     * Get a specific page by its slug.
     *
     * @param string $slug
     * @return array|null
     */
    public function getPageBySlug(string $slug): ?array
    {
        $slugMap = Cache::remember('seo_slug_map', 86400, function () {
            $pages = $this->getAllPages();
            $map = [];
            foreach ($pages as $page) {
                if (isset($page['slug'])) {
                    $map[$page['slug']] = $page;
                }
            }
            return $map;
        });

        return $slugMap[$slug] ?? null;
    }

    /**
     * Get a service by its ID.
     *
     * @param string $id
     * @return array|null
     */
    public function getServiceById(string $id): ?array
    {
        $services = $this->getAllServices();
        foreach ($services as $service) {
            if (($service['id'] ?? null) === $id || ($service['slug'] ?? null) === $id) {
                return $service;
            }
        }
        return null;
    }

    /**
     * Get a location by its ID.
     *
     * @param string $id
     * @return array|null
     */
    public function getLocationById(string $id): ?array
    {
        $locations = $this->getAllLocations();
        foreach ($locations as $location) {
            if (($location['id'] ?? null) === $id || ($location['slug'] ?? null) === $id) {
                return $location;
            }
        }
        return null;
    }

    /**
     * Get related pages based on a service ID or location ID.
     *
     * @param string $pageId
     * @return array
     */
    public function getRelatedPages(string $pageId): array
    {
        $page = null;
        $pages = $this->getAllPages();
        foreach ($pages as $p) {
            if (($p['id'] ?? null) === $pageId) {
                $page = $p;
                break;
            }
        }

        if (!$page) {
            return [];
        }

        $serviceId = $page['service_id'] ?? null;
        $locationId = $page['location_id'] ?? null;
        $related = [];

        foreach ($pages as $p) {
            if (($p['id'] ?? null) === $pageId) {
                continue;
            }
            // Same service or same location, prioritising indexable ones
            if (($p['service_id'] ?? null) === $serviceId || ($p['location_id'] ?? null) === $locationId) {
                $related[] = $p;
            }
        }

        // Sort by priority desc
        usort($related, fn($a, $b) => ($b['priority'] ?? 0) <=> ($a['priority'] ?? 0));

        return array_slice($related, 0, 5);
    }

    /**
     * Get indexable pages.
     *
     * @return array
     */
    public function getIndexablePages(): array
    {
        return array_filter($this->getAllPages(), function ($page) {
            return ($page['indexable'] ?? false) === true && ($page['status'] ?? '') === 'published';
        });
    }

    /**
     * Search pages by service.
     *
     * @param string $serviceId
     * @return array
     */
    public function searchPagesByService(string $serviceId): array
    {
        return array_filter($this->getAllPages(), function ($page) use ($serviceId) {
            return ($page['service_id'] ?? null) === $serviceId;
        });
    }

    /**
     * Search pages by location.
     *
     * @param string $locationId
     * @return array
     */
    public function searchPagesByLocation(string $locationId): array
    {
        return array_filter($this->getAllPages(), function ($page) use ($locationId) {
            return ($page['location_id'] ?? null) === $locationId;
        });
    }

    /**
     * Get all services.
     *
     * @return array
     */
    public function getAllServices(): array
    {
        return Cache::remember('seo_services_all', 86400, function () {
            return $this->loadJsonFile('services.json');
        });
    }

    /**
     * Get all locations.
     *
     * @return array
     */
    public function getAllLocations(): array
    {
        return Cache::remember('seo_locations_all', 86400, function () {
            return $this->loadJsonFile('locations.json');
        });
    }

    /**
     * Get all blog pages.
     *
     * @return array
     */
    public function getAllBlogPages(): array
    {
        return Cache::remember('seo_blogs_all', 86400, function () {
            return $this->loadJsonFile('blog-pages.json');
        });
    }

    /**
     * Clear all cached SEO repositories.
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget('seo_pages_all');
        Cache::forget('seo_services_all');
        Cache::forget('seo_locations_all');
        Cache::forget('seo_blogs_all');
        Cache::forget('seo_slug_map');
    }

    /**
     * Load JSON file from Storage.
     *
     * @param string $filename
     * @return array
     */
    protected function loadJsonFile(string $filename): array
    {
        $path = $this->storagePath . $filename;
        if (!Storage::exists($path)) {
            return [];
        }

        $content = Storage::get($path);
        $data = json_decode($content, true);

        return is_array($data) ? $data : [];
    }
}
