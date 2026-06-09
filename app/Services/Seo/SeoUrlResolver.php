<?php

namespace App\Services\Seo;

class SeoUrlResolver
{
    public function __construct(
        protected SeoDataService $data,
    ) {}

    public function resolve(string $slug): ?array
    {
        $slug = trim($slug, '/');

        if ($slug === '') {
            return null;
        }

        foreach ($this->data->serviceSlugs() as $serviceSlug) {
            if ($slug === $serviceSlug) {
                return $this->finalize('service', $serviceSlug, $serviceSlug, $slug);
            }

            $prefix = $serviceSlug.'-';

            if (! str_starts_with($slug, $prefix)) {
                continue;
            }

            $remainder = substr($slug, strlen($prefix));

            if ($resolved = $this->parseRemainder($serviceSlug, $remainder, $slug)) {
                return $resolved;
            }
        }

        return null;
    }

    public function slug(string $type, string $serviceSlug, ?string $entitySlug = null): string
    {
        $c = config('seo.url_connectors');

        return match ($type) {
            'service' => $serviceSlug,
            'city' => "{$serviceSlug}-{$c['city']}-{$entitySlug}",
            'locality' => "{$serviceSlug}-{$c['locality']}-{$entitySlug}",
            'landmark' => "{$serviceSlug}-{$c['landmark']}-{$entitySlug}",
            'industry' => "{$serviceSlug}-{$c['industry']}-{$entitySlug}",
            'pricing' => "{$serviceSlug}-{$c['pricing']}-{$entitySlug}",
            'guide' => "{$serviceSlug}-{$c['guide']}-{$entitySlug}",
            default => $serviceSlug,
        };
    }

    public function url(string $type, string $serviceSlug, ?string $entitySlug = null): string
    {
        return url('/'.$this->slug($type, $serviceSlug, $entitySlug));
    }

    public function resolveLocation(string $slug): ?array
    {
        return $this->data->find('cities', $slug)
            ?? $this->data->find('localities', $slug);
    }

    protected function parseRemainder(string $serviceSlug, string $remainder, string $requestedSlug): ?array
    {
        $c = config('seo.url_connectors');

        // Pricing: "cost-in-delhi" (canonical) or legacy "cost-delhi"
        foreach ([$c['pricing'], 'cost'] as $pricingPrefix) {
            if (str_starts_with($remainder, $pricingPrefix.'-')) {
                $locationSlug = substr($remainder, strlen($pricingPrefix) + 1);
                if ($this->resolveLocation($locationSlug)) {
                    return $this->finalize('pricing', $serviceSlug, $locationSlug, $requestedSlug);
                }
            }
        }

        // Guide: "guide-in-delhi" (canonical) or legacy "guide-delhi"
        foreach ([$c['guide'], 'guide'] as $guidePrefix) {
            if (str_starts_with($remainder, $guidePrefix.'-')) {
                $locationSlug = substr($remainder, strlen($guidePrefix) + 1);
                if ($this->resolveLocation($locationSlug)) {
                    return $this->finalize('guide', $serviceSlug, $locationSlug, $requestedSlug);
                }
            }
        }

        // Industry: "for-healthcare"
        if (str_starts_with($remainder, $c['industry'].'-')) {
            $industrySlug = substr($remainder, strlen($c['industry']) + 1);
            if ($this->data->find('industries', $industrySlug)) {
                return $this->finalize('industry', $serviceSlug, $industrySlug, $requestedSlug);
            }
        }

        // Near: landmark or locality — "near-india-gate"
        if (str_starts_with($remainder, $c['landmark'].'-')) {
            $entitySlug = substr($remainder, strlen($c['landmark']) + 1);

            if ($this->data->find('landmarks', $entitySlug)) {
                return $this->finalize('landmark', $serviceSlug, $entitySlug, $requestedSlug);
            }

            if ($this->data->find('localities', $entitySlug)) {
                return $this->finalize('locality', $serviceSlug, $entitySlug, $requestedSlug);
            }
        }

        // City: "in-delhi"
        if (str_starts_with($remainder, $c['city'].'-')) {
            $citySlug = substr($remainder, strlen($c['city']) + 1);
            if ($this->data->find('cities', $citySlug)) {
                return $this->finalize('city', $serviceSlug, $citySlug, $requestedSlug);
            }
        }

        // Legacy bare slugs: "delhi", "dwarka-sector-13" (no connector)
        if ($this->data->find('cities', $remainder)) {
            return $this->finalize('city', $serviceSlug, $remainder, $requestedSlug);
        }

        if ($this->data->find('localities', $remainder)) {
            return $this->finalize('locality', $serviceSlug, $remainder, $requestedSlug);
        }

        return null;
    }

    protected function finalize(string $type, string $serviceSlug, ?string $entitySlug, string $requestedSlug): array
    {
        $built = $this->build($type, $serviceSlug, $entitySlug);

        if (empty($built)) {
            return [];
        }

        $canonical = $this->slug($type, $serviceSlug, $entitySlug);

        return array_merge($built, [
            'slug' => $canonical,
            'canonical_slug' => $canonical,
            'requested_slug' => $requestedSlug,
        ]);
    }

    protected function build(string $type, string $serviceSlug, ?string $entitySlug = null): array
    {
        $service = $this->data->find('services', $serviceSlug);

        if (! $service) {
            return [];
        }

        $entity = match ($type) {
            'service' => $service,
            'city' => $this->data->find('cities', $entitySlug),
            'locality' => $this->data->find('localities', $entitySlug),
            'landmark' => $this->data->find('landmarks', $entitySlug),
            'industry' => $this->data->find('industries', $entitySlug),
            'pricing', 'guide' => $this->resolveLocation($entitySlug),
            default => null,
        };

        if ($type !== 'service' && ! $entity) {
            return [];
        }

        return [
            'type' => $type,
            'service' => $service,
            'entity' => $entity,
            'service_slug' => $serviceSlug,
            'entity_slug' => $entitySlug,
        ];
    }
}
