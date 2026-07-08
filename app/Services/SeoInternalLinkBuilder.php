<?php

namespace App\Services;

class SeoInternalLinkBuilder
{
    /**
     * Build the internal linking graph for generated pages.
     *
     * @param array $pages
     * @return array
     */
    public function buildLinks(array $pages): array
    {
        $indexedPages = [];
        foreach ($pages as $p) {
            $indexedPages[$p['slug']] = $p;
        }

        foreach ($pages as &$page) {
            $slug = $page['slug'];
            $serviceId = $page['service_id'];
            $locationId = $page['location_id'];

            $links = [];

            // 1. Link to same service in other key locations
            $sameServicePages = array_filter($pages, function ($p) use ($serviceId, $slug) {
                return $p['service_id'] === $serviceId && $p['slug'] !== $slug && ($p['indexable'] ?? false);
            });
            // Sort by priority desc and pick top 3
            usort($sameServicePages, fn($a, $b) => ($b['priority'] ?? 0) <=> ($a['priority'] ?? 0));
            foreach (array_slice($sameServicePages, 0, 3) as $sp) {
                $links[] = '/' . $sp['slug'];
            }

            // 2. Link to other services in the same location
            $sameLocationPages = array_filter($pages, function ($p) use ($locationId, $slug) {
                return $p['location_id'] === $locationId && $p['slug'] !== $slug && ($p['indexable'] ?? false);
            });
            usort($sameLocationPages, fn($a, $b) => ($b['priority'] ?? 0) <=> ($a['priority'] ?? 0));
            foreach (array_slice($sameLocationPages, 0, 3) as $lp) {
                $links[] = '/' . $lp['slug'];
            }

            // 3. Fallback: add contact or general pages if link count is low
            $links[] = '/contact';
            
            // Remove duplicates and save
            $page['internal_links'] = array_values(array_unique($links));
        }

        return $pages;
    }
}
