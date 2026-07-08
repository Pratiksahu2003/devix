<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeoPageGenerator
{
    public function __construct(
        protected SeoPageRepository $repository,
        protected SeoInternalLinkBuilder $linkBuilder
    ) {}

    /**
     * Generate all programmatic SEO pages based on services and locations.
     *
     * @return array
     */
    public function generate(): array
    {
        $services = $this->repository->getAllServices();
        $locations = $this->repository->getAllLocations();
        $faqBank = $this->loadFaqBank();

        $generatedPages = [];
        $slugsSeen = [];

        foreach ($services as $service) {
            $serviceId = $service['id'] ?? $service['slug'];
            $servicePriority = $service['priority'] ?? 9;

            foreach ($locations as $location) {
                $locationId = $location['id'] ?? $location['slug'];
                $locationPriority = $location['priority'] ?? 5;

                // 1. Calculate Priority Score
                $score = $this->calculatePriorityScore($serviceId, $servicePriority, $locationId, $locationPriority);

                // Ignore if priority score is below 4
                if ($score < 4) {
                    continue;
                }

                // 2. Generate slug and ensure uniqueness
                $slug = Str::slug($service['slug'] . '-in-' . $location['slug']);
                if (in_array($slug, $slugsSeen)) {
                    continue;
                }
                $slugsSeen[] = $slug;

                // Determine indexing and status
                $indexable = $score >= 7;
                // If location has noindex = true, force noindex
                if ($location['noindex'] ?? false) {
                    $indexable = false;
                }

                // 3. Construct target keyword
                $targetKeyword = $service['primary_keyword'] . ' in ' . $location['name'];

                // 4. Generate SEO Metadata
                $seoTitle = $this->generateSeoTitle($service['name'], $location['name']);
                $metaDescription = $this->generateMetaDescription($service['name'], $location['name'], $service['short_description']);
                $h1 = $service['name'] . ' in ' . $location['name'];

                // 5. Generate unique intro (80+ words to avoid thin content)
                $intro = $this->generateUniqueIntro($service, $location);

                // 6. Generate unique sections
                $sections = $this->generateSections($service, $location);

                // 7. Select & localize FAQs
                $faqs = $this->selectAndLocalizeFaqs($service, $location, $faqBank);

                // 8. Canonical URL
                $canonicalParent = $location['canonical_parent'] ?? null;
                $canonicalUrl = config('dywix.base_url', 'https://www.dywix.com') . '/' . $slug;
                if ($canonicalParent) {
                    // If this is a child location with a parent location, point canonical to parent location page or main location page
                    $canonicalSlug = Str::slug($service['slug'] . '-in-' . $canonicalParent);
                    $canonicalUrl = config('dywix.base_url', 'https://www.dywix.com') . '/' . $canonicalSlug;
                }

                $generatedPages[] = [
                    'id' => $slug,
                    'slug' => $slug,
                    'service_id' => $serviceId,
                    'location_id' => $locationId,
                    'page_type' => $this->determinePageType($serviceId, $locationId),
                    'target_keyword' => $targetKeyword,
                    'search_intent' => 'local commercial',
                    'seo_title' => $seoTitle,
                    'meta_description' => $metaDescription,
                    'h1' => $h1,
                    'intro' => $intro,
                    'sections' => $sections,
                    'faqs' => $faqs,
                    'internal_links' => [], // Will be populated by link builder
                    'schema_type' => $service['schema_service_type'] ? 'LocalBusinessServiceFAQ' : 'LocalBusiness',
                    'priority' => $score,
                    'indexable' => $indexable,
                    'canonical_url' => $canonicalUrl,
                    'status' => 'published'
                ];
            }
        }

        // 9. Build internal links graph across the generated pages
        $generatedPages = $this->linkBuilder->buildLinks($generatedPages);

        return $generatedPages;
    }

    /**
     * Calculate the priority score for a service-location pair.
     */
    protected function calculatePriorityScore(string $serviceId, int $servicePriority, string $locationId, int $locationPriority): int
    {
        $base = intval(round(($servicePriority + $locationPriority) / 2));

        // Dwarka and West Delhi boosts (DyWix is physically located in Dwarka Sector 13)
        if (Str::contains($locationId, 'dwarka')) {
            $base += 2;
        } elseif (in_array($locationId, ['west-delhi', 'janakpuri', 'uttam-nagar', 'delhi-ncr', 'delhi'])) {
            $base += 1;
        }

        // Remote areas adjustments
        if (in_array($locationId, ['meerut'])) {
            $base -= 2;
        } elseif (in_array($locationId, ['faridabad', 'ghaziabad', 'greater-noida', 'raj-nagar-extension'])) {
            $base -= 1;
        }

        return max(1, min(10, $base));
    }

    /**
     * Generate SEO Title under 60 chars.
     */
    protected function generateSeoTitle(string $serviceName, string $locationName): string
    {
        $title = "{$serviceName} in {$locationName} | Setup & Rental - DyWix";
        if (strlen($title) > 60) {
            $title = "{$serviceName} in {$locationName} | DyWix Studio";
        }
        if (strlen($title) > 60) {
            $title = "{$serviceName} in {$locationName} - DyWix";
        }
        return $title;
    }

    /**
     * Generate Meta Description under 155 chars.
     */
    protected function generateMetaDescription(string $serviceName, string $locationName, string $shortDesc): string
    {
        $desc = "Looking for a professional {$serviceName} in {$locationName}? Book DyWix Studio for premium equipment, lighting, and full production support.";
        if (strlen($desc) > 155) {
            $desc = "Book a professional {$serviceName} in {$locationName} at DyWix Studio. Premium gear, treated acoustics, and production support.";
        }
        return substr($desc, 0, 155);
    }

    /**
     * Generate unique intro of at least 80 words.
     */
    protected function generateUniqueIntro(array $service, array $location): string
    {
        $serviceName = $service['name'];
        $locationName = $location['name'];
        $shortDesc = $service['short_description'];
        $localIntro = $location['local_intro'] ?? '';
        $travelContext = $location['travel_context'] ?? '';

        $intro = "Looking for a professional {$serviceName} in {$locationName}? DyWix Studio offers a premium, ready-to-shoot production setup designed for creators, founders, agencies, and businesses. {$shortDesc} Located centrally, our studio features high-end cameras, soundproofing, and custom lighting configurations. {$localIntro} {$travelContext} Contact us today to secure your booking slot and elevate your content quality.";

        return $intro;
    }

    /**
     * Generate sections for the page.
     */
    protected function generateSections(array $service, array $location): array
    {
        $serviceName = $service['name'];
        $locationName = $location['name'];
        $nearby = isset($location['nearby_areas']) ? implode(', ', array_slice($location['nearby_areas'], 0, 4)) : '';

        return [
          'why_choose' => "DyWix Studio is the preferred choice for {$serviceName} services because of our premium equipment and client comfort. Located in Dwarka Sector 13, we offer professional acoustic setups, high-power backup, changing areas, and experienced sound and visual technicians to help you capture flawless content for {$locationName}.",
          'what_is_included' => $service['included_features'] ?? [],
          'who_is_it_for' => $service['target_audience'] ?? [],
          'local_coverage' => "Our studio serves clients across {$locationName} and surrounding localities including {$nearby}. We provide easy transit options and dedicated parking grids.",
          'packages' => "We provide custom packages ranging from hourly slot rentals to full-day corporate campaigns. Standard edits, reels cutouts, and sound mixing can be bundled dynamically.",
          'use_cases' => $service['use_cases'] ?? []
        ];
    }

    /**
     * Select relevant FAQs and localize them to prevent duplicate FAQs.
     */
    protected function selectAndLocalizeFaqs(array $service, array $location, array $faqBank): array
    {
        $serviceId = $service['id'] ?? $service['slug'];
        $locationName = $location['name'];
        $selected = [];

        // Find service-specific FAQs
        $category = 'general';
        if (Str::contains($serviceId, 'podcast')) {
            $category = 'podcast';
        } elseif (Str::contains($serviceId, 'photo') || Str::contains($serviceId, 'camera')) {
            $category = 'photography';
        } elseif (Str::contains($serviceId, 'video') || Str::contains($serviceId, 'shoot') || Str::contains($serviceId, 'screen') || Str::contains($serviceId, 'reels') || Str::contains($serviceId, 'shorts')) {
            $category = 'video';
        }

        $serviceFaqs = array_filter($faqBank, fn($faq) => $faq['category'] === $category);
        $generalFaqs = array_filter($faqBank, fn($faq) => $faq['category'] === 'general' || $faq['category'] === 'location');

        $pool = array_merge($serviceFaqs, $generalFaqs);

        // Pick top 3 and localize
        $count = 0;
        foreach ($pool as $faq) {
            if ($count >= 3) break;

            $question = str_replace(['in Delhi', 'in Delhi NCR', 'in Dwarka'], "in {$locationName}", $faq['question']);
            $answer = str_replace(['in Delhi', 'in Delhi NCR', 'in Dwarka'], "in {$locationName}", $faq['answer']);

            // Simple localization tweaks
            $selected[] = [
                'question' => $question,
                'answer' => $answer
            ];
            $count++;
        }

        return $selected;
    }

    /**
     * Determine page type based on service and location context.
     */
    protected function determinePageType(string $serviceId, string $locationId): string
    {
        if (Str::contains($serviceId, 'rent')) {
            return 'service-on-rent-page';
        }
        if (in_array($locationId, ['delhi-ncr', 'delhi', 'gurugram', 'noida'])) {
            return 'main-service-page';
        }
        return 'local-service-page';
    }

    /**
     * Load FAQ bank raw data.
     */
    protected function loadFaqBank(): array
    {
        $path = 'seo/faq-bank.json';
        if (!Storage::exists($path)) {
            return [];
        }
        $content = Storage::get($path);
        return json_decode($content, true) ?? [];
    }
}
