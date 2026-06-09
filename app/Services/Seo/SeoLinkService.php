<?php

namespace App\Services\Seo;

use Illuminate\Support\Collection;

class SeoLinkService
{
    public function __construct(
        protected SeoDataService $data,
        protected SeoUrlResolver $urls,
    ) {}

    public function forHub(string $level, array $resolved): array
    {
        $limits = config("seo.link_limits.{$level}", ['min' => 20, 'max' => 50]);
        $max = $limits['max'];

        $links = match ($resolved['type']) {
            'service' => $this->serviceLinks($resolved, $max),
            'city' => $this->cityLinks($resolved, $max),
            'locality' => $this->localityLinks($resolved, $max),
            'landmark' => $this->landmarkLinks($resolved, $max),
            'industry' => $this->industryLinks($resolved, $max),
            'pricing' => $this->pricingLinks($resolved, $max),
            'guide' => $this->guideLinks($resolved, $max),
            default => collect(),
        };

        return $this->groupLinks($links->take($max));
    }

    public function homepageLinks(): array
    {
        $limits = config('seo.link_limits.homepage', ['max' => 100]);
        $links = collect();

        foreach ($this->data->services() as $service) {
            $links->push($this->link($service['name'], $this->urls->url('service', $service['slug']), 'Services'));
        }

        foreach ($this->data->cities()->take(15) as $city) {
            $service = $this->data->services()->first();
            $links->push($this->link(
                "{$service['name']} in {$city['name']}",
                $this->urls->url('city', $service['slug'], $city['slug']),
                'Popular Locations'
            ));
        }

        foreach ($this->data->localities()->take(20) as $locality) {
            $service = $this->data->services()->first();
            $links->push($this->link(
                "{$service['name']} near {$locality['name']}",
                $this->urls->url('locality', $service['slug'], $locality['slug']),
                'Localities'
            ));
        }

        foreach ($this->data->industries()->take(10) as $industry) {
            $service = $this->data->services()->first();
            $links->push($this->link(
                "{$service['name']} for {$industry['name']}",
                $this->urls->url('industry', $service['slug'], $industry['slug']),
                'Industries'
            ));
        }

        $links->push($this->link('All Locations', route('seo.locations'), 'Hubs'));
        $links->push($this->link('All Industries', route('seo.industries'), 'Hubs'));
        $links->push($this->link('Guides', route('seo.guides'), 'Hubs'));
        $links->push($this->link('Resources', route('seo.resources'), 'Hubs'));
        $links->push($this->link('SEO Directory', route('seo.directory'), 'Hubs'));
        $links->push($this->link('Pricing', route('pages.pricing'), 'Hubs'));
        $links->push($this->link('Blog', route('blog.index'), 'Hubs'));

        return $this->groupLinks($links->take($limits['max']));
    }

    public function allPages(): Collection
    {
        $pages = collect();

        foreach ($this->data->services() as $service) {
            $pages->push(['type' => 'service', 'title' => $service['name'], 'url' => $this->urls->url('service', $service['slug']), 'category' => 'Services']);

            foreach ($this->data->cities() as $city) {
                $pages->push(['type' => 'city', 'title' => "{$service['name']} in {$city['name']}", 'url' => $this->urls->url('city', $service['slug'], $city['slug']), 'category' => 'Cities']);
            }

            foreach ($this->data->localities() as $locality) {
                $pages->push(['type' => 'locality', 'title' => "{$service['name']} near {$locality['name']}", 'url' => $this->urls->url('locality', $service['slug'], $locality['slug']), 'category' => 'Localities']);
            }

            foreach ($this->data->landmarks() as $landmark) {
                $pages->push(['type' => 'landmark', 'title' => "{$service['name']} near {$landmark['name']}", 'url' => $this->urls->url('landmark', $service['slug'], $landmark['slug']), 'category' => 'Landmarks']);
            }

            foreach ($this->data->industries() as $industry) {
                $pages->push(['type' => 'industry', 'title' => "{$service['name']} for {$industry['name']}", 'url' => $this->urls->url('industry', $service['slug'], $industry['slug']), 'category' => 'Industries']);
            }

            foreach ($this->data->cities() as $city) {
                $pages->push(['type' => 'pricing', 'title' => "{$service['name']} Cost in {$city['name']}", 'url' => $this->urls->url('pricing', $service['slug'], $city['slug']), 'category' => 'Pricing']);
                $pages->push(['type' => 'guide', 'title' => "{$service['name']} Guide — {$city['name']}", 'url' => $this->urls->url('guide', $service['slug'], $city['slug']), 'category' => 'Guides']);
            }
        }

        foreach ($this->data->blogs() as $blog) {
            $pages->push(['type' => 'blog', 'title' => $blog['title'], 'url' => route('blog.show', $blog['slug']), 'category' => 'Blog']);
        }

        return $pages;
    }

    protected function serviceLinks(array $resolved, int $max): Collection
    {
        $service = $resolved['service'];
        $links = collect();

        foreach ($this->data->cities() as $city) {
            $links->push($this->link("{$service['name']} in {$city['name']}", $this->urls->url('city', $service['slug'], $city['slug']), 'Cities'));
        }

        foreach ($this->data->localities()->take(25) as $locality) {
            $links->push($this->link("Near {$locality['name']}", $this->urls->url('locality', $service['slug'], $locality['slug']), 'Localities'));
        }

        foreach ($this->data->landmarks()->take(15) as $landmark) {
            $links->push($this->link("Near {$landmark['name']}", $this->urls->url('landmark', $service['slug'], $landmark['slug']), 'Landmarks'));
        }

        foreach ($this->data->industries() as $industry) {
            $links->push($this->link("For {$industry['name']}", $this->urls->url('industry', $service['slug'], $industry['slug']), 'Industries'));
        }

        foreach ($this->data->cities()->take(10) as $city) {
            $links->push($this->link("Cost in {$city['name']}", $this->urls->url('pricing', $service['slug'], $city['slug']), 'Pricing'));
            $links->push($this->link("Guide — {$city['name']}", $this->urls->url('guide', $service['slug'], $city['slug']), 'Guides'));
        }

        foreach ($this->data->blogs()->where('service', $service['slug'])->take(5) as $blog) {
            $links->push($this->link($blog['title'], route('blog.show', $blog['slug']), 'Related Articles'));
        }

        $relatedServices = $this->data->services()->where('slug', '!=', $service['slug'])->take(5);
        foreach ($relatedServices as $related) {
            $links->push($this->link($related['name'], $this->urls->url('service', $related['slug']), 'Related Services'));
        }

        return $links->take($max);
    }

    protected function cityLinks(array $resolved, int $max): Collection
    {
        $service = $resolved['service'];
        $city = $resolved['entity'];
        $links = collect();

        $links->push($this->link($service['name'], $this->urls->url('service', $service['slug']), 'Service'));

        $localities = $this->data->localities()->filter(fn ($l) => ($l['city'] ?? '') === $city['slug'])->take(15);
        foreach ($localities as $locality) {
            $links->push($this->link("Near {$locality['name']}", $this->urls->url('locality', $service['slug'], $locality['slug']), 'Localities'));
        }

        $landmarks = $this->data->landmarks()->filter(fn ($l) => ($l['city'] ?? '') === $city['slug'])->take(10);
        foreach ($landmarks as $landmark) {
            $links->push($this->link("Near {$landmark['name']}", $this->urls->url('landmark', $service['slug'], $landmark['slug']), 'Landmarks'));
        }

        foreach ($this->data->industries()->take(10) as $industry) {
            $links->push($this->link("For {$industry['name']}", $this->urls->url('industry', $service['slug'], $industry['slug']), 'Industries'));
        }

        $links->push($this->link("Cost in {$city['name']}", $this->urls->url('pricing', $service['slug'], $city['slug']), 'Pricing'));
        $links->push($this->link("Guide — {$city['name']}", $this->urls->url('guide', $service['slug'], $city['slug']), 'Guides'));

        foreach ($this->data->cities()->where('slug', '!=', $city['slug'])->take(8) as $otherCity) {
            $links->push($this->link("{$service['name']} in {$otherCity['name']}", $this->urls->url('city', $service['slug'], $otherCity['slug']), 'Other Cities'));
        }

        return $links->take($max);
    }

    protected function localityLinks(array $resolved, int $max): Collection
    {
        $service = $resolved['service'];
        $locality = $resolved['entity'];
        $links = collect();

        $links->push($this->link($service['name'], $this->urls->url('service', $service['slug']), 'Service'));

        if ($city = $this->data->find('cities', $locality['city'] ?? '')) {
            $links->push($this->link("{$service['name']} in {$city['name']}", $this->urls->url('city', $service['slug'], $city['slug']), 'City'));
        }

        foreach (($locality['nearby'] ?? []) as $nearbySlug) {
            if ($nearby = $this->data->find('localities', $nearbySlug)) {
                $links->push($this->link("Near {$nearby['name']}", $this->urls->url('locality', $service['slug'], $nearby['slug']), 'Nearby Areas'));
            }
        }

        foreach ($this->data->landmarks()->take(8) as $landmark) {
            $links->push($this->link("Near {$landmark['name']}", $this->urls->url('landmark', $service['slug'], $landmark['slug']), 'Landmarks'));
        }

        foreach ($this->data->industries()->take(8) as $industry) {
            $links->push($this->link("For {$industry['name']}", $this->urls->url('industry', $service['slug'], $industry['slug']), 'Industries'));
        }

        $relatedServices = $this->data->services()->where('slug', '!=', $service['slug'])->take(4);
        foreach ($relatedServices as $related) {
            $links->push($this->link("{$related['name']} near {$locality['name']}", $this->urls->url('locality', $related['slug'], $locality['slug']), 'Related Services'));
        }

        return $links->take($max);
    }

    protected function landmarkLinks(array $resolved, int $max): Collection
    {
        $service = $resolved['service'];
        $landmark = $resolved['entity'];
        $links = collect();

        $links->push($this->link($service['name'], $this->urls->url('service', $service['slug']), 'Service'));

        foreach (($landmark['nearby_areas'] ?? []) as $areaSlug) {
            if ($locality = $this->data->find('localities', $areaSlug)) {
                $links->push($this->link("Near {$locality['name']}", $this->urls->url('locality', $service['slug'], $locality['slug']), 'Nearby Areas'));
            }
        }

        if ($city = $this->data->find('cities', $landmark['city'] ?? '')) {
            $links->push($this->link("{$service['name']} in {$city['name']}", $this->urls->url('city', $service['slug'], $city['slug']), 'City'));
        }

        foreach ($this->data->industries()->take(8) as $industry) {
            $links->push($this->link("For {$industry['name']}", $this->urls->url('industry', $service['slug'], $industry['slug']), 'Industries'));
        }

        return $links->take($max);
    }

    protected function industryLinks(array $resolved, int $max): Collection
    {
        $service = $resolved['service'];
        $industry = $resolved['entity'];
        $links = collect();

        $links->push($this->link($service['name'], $this->urls->url('service', $service['slug']), 'Service'));

        foreach ($this->data->cities()->take(10) as $city) {
            $links->push($this->link("{$service['name']} in {$city['name']}", $this->urls->url('city', $service['slug'], $city['slug']), 'Locations'));
            $links->push($this->link("Cost in {$city['name']}", $this->urls->url('pricing', $service['slug'], $city['slug']), 'Pricing'));
        }

        foreach ($this->data->blogs()->where('service', $service['slug'])->take(5) as $blog) {
            $links->push($this->link($blog['title'], route('blog.show', $blog['slug']), 'Guides & Articles'));
        }

        $relatedIndustries = $this->data->industries()->where('slug', '!=', $industry['slug'])->take(6);
        foreach ($relatedIndustries as $related) {
            $links->push($this->link("For {$related['name']}", $this->urls->url('industry', $service['slug'], $related['slug']), 'Related Industries'));
        }

        return $links->take($max);
    }

    protected function pricingLinks(array $resolved, int $max): Collection
    {
        $service = $resolved['service'];
        $location = $resolved['entity'];
        $links = collect();

        $links->push($this->link('Book Now', route('pages.booking'), 'Booking'));
        $links->push($this->link($service['name'], $this->urls->url('service', $service['slug']), 'Service'));
        $links->push($this->link("Guide — {$location['name']}", $this->urls->url('guide', $service['slug'], $location['slug']), 'Guides'));
        $links->push($this->link('Full Pricing', route('pages.pricing'), 'Pricing'));

        foreach ($this->data->cities()->where('slug', '!=', $location['slug'])->take(8) as $city) {
            $links->push($this->link("Cost in {$city['name']}", $this->urls->url('pricing', $service['slug'], $city['slug']), 'Other Locations'));
        }

        foreach ($this->data->industries()->take(6) as $industry) {
            $links->push($this->link("For {$industry['name']}", $this->urls->url('industry', $service['slug'], $industry['slug']), 'Industries'));
        }

        return $links->take($max);
    }

    protected function guideLinks(array $resolved, int $max): Collection
    {
        $service = $resolved['service'];
        $location = $resolved['entity'];
        $links = collect();

        $links->push($this->link($service['name'], $this->urls->url('service', $service['slug']), 'Service'));
        $links->push($this->link("Cost in {$location['name']}", $this->urls->url('pricing', $service['slug'], $location['slug']), 'Pricing'));

        foreach ($this->data->blogs()->where('service', $service['slug'])->take(8) as $blog) {
            $links->push($this->link($blog['title'], route('blog.show', $blog['slug']), 'Related Articles'));
        }

        foreach ($this->data->industries()->take(6) as $industry) {
            $links->push($this->link("For {$industry['name']}", $this->urls->url('industry', $service['slug'], $industry['slug']), 'Industries'));
        }

        foreach ($this->data->cities()->where('slug', '!=', $location['slug'])->take(6) as $city) {
            $links->push($this->link("Guide — {$city['name']}", $this->urls->url('guide', $service['slug'], $city['slug']), 'Other Guides'));
        }

        return $links->take($max);
    }

    protected function link(string $label, string $url, string $group): array
    {
        return compact('label', 'url', 'group');
    }

    protected function groupLinks(Collection $links): array
    {
        return $links->groupBy('group')->map(fn ($group) => $group->values()->all())->all();
    }
}
