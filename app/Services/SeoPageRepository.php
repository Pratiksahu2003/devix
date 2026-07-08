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

        if (isset($slugMap[$slug])) {
            return $slugMap[$slug];
        }

        return $this->resolveDynamicPage($slug);
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
            $baseLocations = $this->loadJsonFile('locations.json');
            $expanded = [];

            foreach ($baseLocations as $loc) {
                $expanded[] = $loc;

                // Hyperlocal sector expansion for Dwarka, Noida, Gurugram
                $slug = $loc['slug'] ?? '';
                if ($slug === 'dwarka') {
                    for ($i = 1; $i <= 23; $i++) {
                        $expanded[] = [
                            'id' => "dwarka-sector-{$i}",
                            'name' => "Dwarka Sector {$i}",
                            'slug' => "dwarka-sector-{$i}",
                            'city' => 'Delhi',
                            'region' => 'Delhi NCR',
                            'nearby_areas' => ["Dwarka Sector " . (($i % 23) + 1), "Dwarka Sector " . (($i + 5) % 23 + 1)],
                            'local_intro' => "Dwarka Sector {$i} is a fast-growing residential and commercial locality in West Delhi, requiring premium digital recording options.",
                            'travel_context' => "DyWix Studio is located in Dwarka Sector 13, offering rapid transit via the Delhi Metro Blue Line to Dwarka Sector {$i}.",
                            'priority' => 8,
                            'create_pages' => true,
                            'noindex' => false,
                            'canonical_parent' => 'dwarka'
                        ];
                    }
                } elseif ($slug === 'noida') {
                    $noidaSectors = [1, 2, 3, 4, 15, 16, 18, 19, 22, 25, 27, 29, 30, 37, 39, 44, 45, 50, 51, 52, 59, 60, 61, 62, 63, 70, 71, 72, 73, 74, 75, 76, 78, 81, 82, 125, 126, 127, 128, 137];
                    foreach ($noidaSectors as $sec) {
                        $expanded[] = [
                            'id' => "noida-sector-{$sec}",
                            'name' => "Noida Sector {$sec}",
                            'slug' => "noida-sector-{$sec}",
                            'city' => 'Noida',
                            'region' => 'Delhi NCR',
                            'nearby_areas' => ["Noida Sector " . ($sec + 1), "Noida Sector " . ($sec - 1)],
                            'local_intro' => "Noida Sector {$sec} is a prime business park and residential zone, demanding professional audio and visual production services.",
                            'travel_context' => "Conveniently connected via major expressways, creators from Noida Sector {$sec} can access DyWix Studio for premium production setups.",
                            'priority' => 7,
                            'create_pages' => true,
                            'noindex' => false,
                            'canonical_parent' => 'noida'
                        ];
                    }
                } elseif ($slug === 'gurugram') {
                    $gurugramSectors = [1, 2, 4, 5, 9, 10, 14, 15, 21, 22, 23, 24, 25, 27, 28, 29, 30, 31, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 62, 65];
                    foreach ($gurugramSectors as $sec) {
                        $expanded[] = [
                            'id' => "gurugram-sector-{$sec}",
                            'name' => "Gurugram Sector {$sec}",
                            'slug' => "gurugram-sector-{$sec}",
                            'city' => 'Gurugram',
                            'region' => 'Delhi NCR',
                            'nearby_areas' => ["Gurugram Sector " . ($sec + 1), "Gurugram Sector " . ($sec - 1)],
                            'local_intro' => "Gurugram Sector {$sec} is a bustling corporate hub filled with agencies, startups, and visual content creators.",
                            'travel_context' => "Our Dwarka studio provides seamless metro and expressway access for individuals traveling from Gurugram Sector {$sec}.",
                            'priority' => 7,
                            'create_pages' => true,
                            'noindex' => false,
                            'canonical_parent' => 'gurugram'
                        ];
                    }
                }
            }

            return $expanded;
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
        $path = storage_path('app/seo/' . $filename);
        if (!file_exists($path)) {
            return [];
        }

        $content = file_get_contents($path);
        $data = json_decode($content, true);

        return is_array($data) ? $data : [];
    }

    /**
     * Resolve any programmatic slug dynamically on the fly.
     *
     * @param string $slug
     * @return array|null
     */
    public function resolveDynamicPage(string $slug): ?array
    {
        $services = $this->getAllServices();
        $locations = $this->getAllLocations();

        $variants = $this->getTemplateVariants();

        // O(S + L) quick check to see if slug matches
        foreach ($services as $service) {
            $sSlug = $service['slug'] ?? '';
            if (empty($sSlug) || !str_contains($slug, $sSlug)) continue;

            foreach ($locations as $location) {
                $lSlug = $location['slug'] ?? '';
                if (empty($lSlug) || !str_contains($slug, $lSlug)) continue;

                foreach ($variants as $variant => $pattern) {
                    $tSlug = str_replace(['{service}', '{location}'], [$sSlug, $lSlug], $pattern);
                    if ($slug === $tSlug) {
                        return $this->buildDynamicPageData($service, $location, $variant, $slug);
                    }
                }
            }
        }

        return null;
    }

    /**
     * List of all 50 programmatic SEO templates.
     */
    public function getTemplateVariants(): array
    {
        return [
            'best' => 'best-{service}-in-{location}',
            'affordable' => 'affordable-{service}-in-{location}',
            'professional' => 'professional-{service}-in-{location}',
            'price' => '{service}-price-in-{location}',
            'cost' => '{service}-cost-in-{location}',
            'booking' => '{service}-booking-in-{location}',
            'rent' => '{service}-on-rent-in-{location}',
            'near' => '{service}-near-{location}',
            'default' => '{service}-in-{location}',
            'startups' => '{service}-for-startups-in-{location}',
            'realestate' => '{service}-for-real-estate-in-{location}',
            'healthcare' => '{service}-for-healthcare-in-{location}',
            'corporate' => '{service}-for-corporate-in-{location}',
            'educators' => '{service}-for-educators-in-{location}',
            'agencies' => '{service}-for-agencies-in-{location}',
            'fashion' => '{service}-for-fashion-in-{location}',
            'ecommerce' => '{service}-for-e-commerce-in-{location}',
            'musicians' => '{service}-for-musicians-in-{location}',
            'fitness' => '{service}-for-fitness-in-{location}',
            'toprated' => 'top-rated-{service}-in-{location}',
            'certified' => 'certified-{service}-in-{location}',
            'reviews' => '{service}-reviews-in-{location}',
            'portfolio' => '{service}-portfolio-in-{location}',
            'casestudies' => '{service}-case-studies-in-{location}',
            'experts' => '{service}-experts-in-{location}',
            'guidelines' => '{service}-guidelines-in-{location}',
            'standards' => '{service}-standards-in-{location}',
            'checklist' => '{service}-checklist-in-{location}',
            'trusted' => 'trusted-{service}-in-{location}',
            'verified' => 'verified-{service}-in-{location}',
            'packages' => '{service}-packages-in-{location}',
            'deals' => '{service}-deals-in-{location}',
            'offers' => '{service}-offers-in-{location}',
            'discounts' => '{service}-discounts-in-{location}',
            'custom' => 'custom-{service}-in-{location}',
            'alternative' => 'alternative-{service}-in-{location}',
            'howtochoose' => 'how-to-choose-{service}-in-{location}',
            'hire' => 'hire-{service}-in-{location}',
            'find' => 'find-{service}-in-{location}',
            'local' => 'local-{service}-in-{location}',
            'top' => 'top-{service}-in-{location}',
            'premium' => 'premium-{service}-in-{location}',
            'quality' => 'quality-{service}-in-{location}',
            'expert' => 'expert-{service}-in-{location}',
            'reliable' => 'reliable-{service}-in-{location}',
            'creative' => 'creative-{service}-in-{location}',
            'modern' => 'modern-{service}-in-{location}',
            'lowcost' => 'low-cost-{service}-in-{location}',
            'budget' => 'budget-{service}-in-{location}',
            'exclusive' => 'exclusive-{service}-in-{location}'
        ];
    }

    /**
     * Build programmatic landing page details in real-time.
     */
    protected function buildDynamicPageData(array $service, array $location, string $variant, string $slug): array
    {
        $serviceName = $service['name'] ?? '';
        $locationName = $location['name'] ?? '';
        $primaryKeyword = $service['primary_keyword'] ?? '';

        $intentPhrases = [
            'best' => ["best {$primaryKeyword} in {$locationName}", "Best {$serviceName} in {$locationName}", "Best {$serviceName} in {$locationName} | Top-Rated - DyWix", "Looking for the best {$serviceName} in {$locationName}? Book DyWix Studio for premium equipment, treated acoustics, and full production support."],
            'affordable' => ["affordable {$primaryKeyword} in {$locationName}", "Affordable {$serviceName} in {$locationName}", "Affordable {$serviceName} in {$locationName} | Budget Rates", "Get professional {$serviceName} in {$locationName} at affordable rates. High-quality production setups and hourly rentals at DyWix Studio."],
            'professional' => ["professional {$primaryKeyword} in {$locationName}", "Professional {$serviceName} in {$locationName}", "Professional {$serviceName} in {$locationName} | DyWix Studio", "Book professional {$serviceName} in {$locationName} at DyWix Studio. Expert team, cinema-grade camera rigs, and clean audio environments."],
            'price' => ["{$primaryKeyword} price in {$locationName}", "{$serviceName} Price in {$locationName}", "{$serviceName} Price in {$locationName} | Rates & Booking", "Find pricing and rental packages for {$serviceName} in {$locationName}. Clear hourly rates, half-day discounts, and custom proposals."],
            'cost' => ["{$primaryKeyword} cost in {$locationName}", "{$serviceName} Cost in {$locationName}", "{$serviceName} Cost in {$locationName} | Pricing Packages", "Compare {$serviceName} cost in {$locationName}. Get clear pricing details for studio rentals, equipment hire, and post-production editing."],
            'booking' => ["{$primaryKeyword} booking in {$locationName}", "{$serviceName} Booking in {$locationName}", "{$serviceName} Booking in {$locationName} | Secure Your Slot", "Secure your slot for {$serviceName} in {$locationName} at DyWix Studio. Easy online booking, WhatsApp assistance, and 24x7 support."],
            'rent' => ["{$primaryKeyword} on rent in {$locationName}", "{$serviceName} on Rent in {$locationName}", "{$serviceName} on Rent in {$locationName} | Hourly Rental", "Rent professional {$serviceName} space and gear in {$locationName} on an hourly or daily package. Custom sets and support technician included."],
            'near' => ["{$primaryKeyword} near {$locationName}", "{$serviceName} Near {$locationName}", "{$serviceName} Near {$locationName} | Local Production Space", "Find professional {$serviceName} near {$locationName}. Located centrally at Dwarka Sector 13 with direct metro connectivity and parking."],
            'default' => ["{$primaryKeyword} in {$locationName}", "{$serviceName} in {$locationName}", "{$serviceName} in {$locationName} | Setup & Rental - DyWix", "Book a professional {$serviceName} in {$locationName} at DyWix Studio. Premium gear, treated acoustics, and production support."],
            
            // Industries
            'startups' => ["{$primaryKeyword} for startups in {$locationName}", "{$serviceName} for Startups in {$locationName}", "{$serviceName} for Startups in {$locationName} | Launch Special", "Grow your startup with high-quality content. Professional {$serviceName} services custom-tailored for startups and founders in {$locationName}."],
            'realestate' => ["{$primaryKeyword} for real estate in {$locationName}", "{$serviceName} for Real Estate in {$locationName}", "{$serviceName} for Real Estate in {$locationName} | Pro Visuals", "Elevate real estate listings with high-end {$serviceName} assets. Professional studio and production services in {$locationName}."],
            'healthcare' => ["{$primaryKeyword} for healthcare in {$locationName}", "{$serviceName} for Healthcare in {$locationName}", "{$serviceName} for Healthcare & Doctors in {$locationName}", "Build trust with medical and healthcare content. Certified {$serviceName} solutions for doctors and clinics in {$locationName}."],
            'corporate' => ["{$primaryKeyword} for corporate in {$locationName}", "{$serviceName} for Corporate in {$locationName}", "Corporate {$serviceName} in {$locationName} | Video & Audio", "Premium corporate and brand production campaigns. Book professional {$serviceName} tailored for businesses in {$locationName}."],
            'educators' => ["{$primaryKeyword} for educators in {$locationName}", "{$serviceName} for Educators in {$locationName}", "{$serviceName} for Educators & Courses in {$locationName}", "Record online courses, lectures, and educational content. Secure acoustic {$serviceName} environments for educators in {$locationName}."],
            'agencies' => ["{$primaryKeyword} for agencies in {$locationName}", "{$serviceName} for Agencies in {$locationName}", "{$serviceName} for Marketing Agencies in {$locationName}", "Scale your agency's content output. Whitelabel and custom {$serviceName} production packages for agencies in {$locationName}."],
            'fashion' => ["{$primaryKeyword} for fashion in {$locationName}", "{$serviceName} for Fashion in {$locationName}", "{$serviceName} for Fashion Brands in {$locationName}", "Shoot premium lookbooks and fashion campaigns. Dynamic, customizable {$serviceName} sets for brands in {$locationName}."],
            'ecommerce' => ["{$primaryKeyword} for e-commerce in {$locationName}", "{$serviceName} for E-commerce in {$locationName}", "{$serviceName} for E-commerce & Amazon in {$locationName}", "Increase product sales with crisp visuals. High-converting {$serviceName} setups for e-commerce brands in {$locationName}."],
            'musicians' => ["{$primaryKeyword} for musicians in {$locationName}", "{$serviceName} for Musicians in {$locationName}", "{$serviceName} for Musicians & Artists in {$locationName}", "Record music videos, interviews, and session tracks. Acoustically optimized {$serviceName} for artists in {$locationName}."],
            'fitness' => ["{$primaryKeyword} for fitness in {$locationName}", "{$serviceName} for Fitness in {$locationName}", "{$serviceName} for Fitness & Gyms in {$locationName}", "Shoot high-energy fitness courses and training reels. Top-tier {$serviceName} spaces for trainers in {$locationName}."],

            // E-E-A-T & Trust
            'toprated' => ["top rated {$primaryKeyword} in {$locationName}", "Top-Rated {$serviceName} in {$locationName}", "Top-Rated {$serviceName} in {$locationName} | 5-Star Studio", "Book top-rated {$serviceName} services in {$locationName}. Award-winning audio visual space with verified creator reviews and high client retention."],
            'certified' => ["certified {$primaryKeyword} in {$locationName}", "Certified {$serviceName} in {$locationName}", "Certified {$serviceName} in {$locationName} | DyWix", "Get certified {$serviceName} production solutions. High-quality specifications, treated acoustics, and expert engineers in {$locationName}."],
            'reviews' => ["{$primaryKeyword} reviews in {$locationName}", "{$serviceName} Reviews in {$locationName}", "Verified {$serviceName} Reviews in {$locationName}", "Read verified client testimonials and reviews for {$serviceName} in {$locationName}. See why creators rate DyWix Studio 4.9/5 stars."],
            'portfolio' => ["{$primaryKeyword} portfolio in {$locationName}", "{$serviceName} Portfolio in {$locationName}", "{$serviceName} Portfolio & Past Projects", "Explore our portfolio of past {$serviceName} projects shot for local brands and creators in {$locationName}. High-definition case studies."],
            'casestudies' => ["{$primaryKeyword} case studies in {$locationName}", "{$serviceName} Case Studies in {$locationName}", "{$serviceName} Case Studies & Client Success", "Discover how our {$serviceName} solutions drove audience growth and branding success for creators and companies in {$locationName}."],
            'experts' => ["{$primaryKeyword} experts in {$locationName}", "{$serviceName} Experts in {$locationName}", "{$serviceName} Experts & Production Team", "Work with certified audio-visual engineers and {$serviceName} experts in {$locationName}. Full end-to-end guidance from DyWix."],
            'guidelines' => ["{$primaryKeyword} guidelines in {$locationName}", "{$serviceName} Guidelines in {$locationName}", "{$serviceName} Recording Guidelines & Tips", "Learn the essential standards and guidelines for getting perfect {$serviceName} outputs in {$locationName}. Expert insights from DyWix."],
            'standards' => ["{$primaryKeyword} standards in {$locationName}", "{$serviceName} Standards in {$locationName}", "Professional {$serviceName} Quality Standards", "We adhere to strict acoustic and visual standards for all {$serviceName} services in {$locationName}. Browse our setup specs."],
            'checklist' => ["{$primaryKeyword} checklist in {$locationName}", "{$serviceName} Checklist in {$locationName}", "{$serviceName} Pre-Recording Checklist", "Use our free pre-production checklist to prepare for your next {$serviceName} session in {$locationName}. Arrive ready to create."],
            'trusted' => ["trusted {$primaryKeyword} in {$locationName}", "Trusted {$serviceName} in {$locationName}", "Trusted {$serviceName} Space in {$locationName}", "Partner with the most trusted {$serviceName} provider in {$locationName}. Safe, professional, and well-equipped studio setups."],
            'verified' => ["verified {$primaryKeyword} in {$locationName}", "Verified {$serviceName} in {$locationName}", "Verified {$serviceName} Studio - DyWix", "Book verified {$serviceName} services in {$locationName}. Safe transactions, high-end gear, and fully authenticated professional reviews."],

            // Time & Seasonality
            'packages' => ["{$primaryKeyword} packages in {$locationName}", "{$serviceName} Packages in {$locationName}", "{$serviceName} Packages & Pricing", "Compare available packages for {$serviceName} in {$locationName}. Save up to 20% on monthly retainers or bulk hourly slots."],
            'deals' => ["{$primaryKeyword} deals in {$locationName}", "{$serviceName} Deals in {$locationName}", "Best {$serviceName} Deals & Slots", "Claim limited-time deals on professional {$serviceName} in {$locationName}. Get discounted weekend slots and gear add-ons."],
            'offers' => ["{$primaryKeyword} offers in {$locationName}", "{$serviceName} Offers in {$locationName}", "{$serviceName} Promotional Offers", "Explore active promotional offers on {$serviceName} in {$locationName} at DyWix Studio. Special creator rates apply."],
            'discounts' => ["{$primaryKeyword} discounts in {$locationName}", "{$serviceName} Discounts in {$locationName}", "{$serviceName} Creator Discounts", "Get exclusive discounts on {$serviceName} bookings in {$locationName}. Reduced pricing for students and NGOs."],
            'custom' => ["custom {$primaryKeyword} in {$locationName}", "Custom {$serviceName} in {$locationName}", "Custom {$serviceName} Setups & Design", "Need a custom set design or special equipment? Request custom {$serviceName} services in {$locationName} for tailored campaigns."],

            // Comparison & Alternative
            'alternative' => ["alternative {$primaryKeyword} in {$locationName}", "Alternative {$serviceName} in {$locationName}", "Best Alternative {$serviceName} in {$locationName}", "Looking for a better alternative to standard {$serviceName} options in {$locationName}? Discover why creators choose DyWix."],
            'howtochoose' => ["how to choose {$primaryKeyword} in {$locationName}", "How to Choose {$serviceName} in {$locationName}", "How to Choose the Right {$serviceName}", "Expert guide on how to choose a professional {$serviceName} in {$locationName} based on acoustics, equipment, and technicians."],
            'hire' => ["hire {$primaryKeyword} in {$locationName}", "Hire {$serviceName} in {$locationName}", "Hire {$serviceName} Specialists in {$locationName}", "Hire a professional team and space for {$serviceName} in {$locationName}. DyWix provides studio setups and post-production crews."],
            'find' => ["find {$primaryKeyword} in {$locationName}", "Find {$serviceName} in {$locationName}", "Find {$serviceName} Studio in {$locationName}", "Easily find and book a professional {$serviceName} in {$locationName}. Located near public transit with easy hourly booking."],
            'local' => ["local {$primaryKeyword} in {$locationName}", "Local {$serviceName} in {$locationName}", "Local {$serviceName} Provider - DyWix", "Support your local creator community. Rent premium {$serviceName} services in {$locationName} with convenient access."],

            // Adjective Prefixes
            'top' => ["top {$primaryKeyword} in {$locationName}", "Top {$serviceName} in {$locationName}", "Top {$serviceName} in {$locationName} | Premium Space", "Discover the top {$serviceName} in {$locationName}. Access top-tier recording booths, sound engineering, and lighting configurations."],
            'premium' => ["premium {$primaryKeyword} in {$locationName}", "Premium {$serviceName} in {$locationName}", "Premium {$serviceName} in {$locationName} | DyWix", "Experience premium {$serviceName} services in {$locationName}. State-of-the-art studio monitors, treated acoustics, and 4K video feeds."],
            'quality' => ["quality {$primaryKeyword} in {$locationName}", "Quality {$serviceName} in {$locationName}", "Quality {$serviceName} Setup in {$locationName}", "Get high-quality {$serviceName} recordings in {$locationName}. Pristine sound capture and visual styling guaranteed at DyWix."],
            'expert' => ["expert {$primaryKeyword} in {$locationName}", "Expert {$serviceName} in {$locationName}", "Expert {$serviceName} Services - DyWix", "Book expert {$serviceName} in {$locationName}. Work with senior production specialists to edit, record, and optimize your videos."],
            'reliable' => ["reliable {$primaryKeyword} in {$locationName}", "Reliable {$serviceName} in {$locationName}", "Reliable {$serviceName} Provider in {$locationName}", "Looking for a reliable {$serviceName} in {$locationName}? Enjoy zero technical failures, backup power, and dedicated support."],
            'creative' => ["creative {$primaryKeyword} in {$locationName}", "Creative {$serviceName} in {$locationName}", "Creative {$serviceName} Studio in {$locationName}", "Unleash your potential with creative {$serviceName} spaces in {$locationName}. Flexible background colors, props, and lighting."],
            'modern' => ["modern {$primaryKeyword} in {$locationName}", "Modern {$serviceName} in {$locationName}", "Modern {$serviceName} in {$locationName} | DyWix", "Record in a modern {$serviceName} setup in {$locationName} featuring contemporary styling, RGB backlighting, and dynamic mixers."],
            'lowcost' => ["low cost {$primaryKeyword} in {$locationName}", "Low-Cost {$serviceName} in {$locationName}", "Low-Cost {$serviceName} Setup in {$locationName}", "Save money without sacrificing content quality. Rent low-cost {$serviceName} in {$locationName} starting at budget rates."],
            'budget' => ["budget {$primaryKeyword} in {$locationName}", "Budget {$serviceName} in {$locationName}", "Budget {$serviceName} in {$locationName} | DyWix", "Find cheap and budget-friendly {$serviceName} options in {$locationName}. Flexible hours, packages, and transparent pricing."],
            'exclusive' => ["exclusive {$primaryKeyword} in {$locationName}", "Exclusive {$serviceName} in {$locationName}", "Exclusive {$serviceName} Space - DyWix", "Book an exclusive {$serviceName} slot in {$locationName}. Get private studio access, personalized editing, and VIP client service."]
        ];

        $phrase = $intentPhrases[$variant] ?? $intentPhrases['default'];

        $targetKeyword = $phrase[0];
        $h1 = $phrase[1];
        $seoTitle = $phrase[2];
        $metaDesc = $phrase[3];

        $servicePriority = $service['priority'] ?? 9;
        $locationPriority = $location['priority'] ?? 5;
        $score = $this->calculatePriorityScore($service['id'] ?? '', $servicePriority, $location['id'] ?? '', $locationPriority);

        $indexable = $score >= 7 && !($location['noindex'] ?? false);

        // Generate unique intro (80+ words)
        $localIntro = $location['local_intro'] ?? '';
        $travelContext = $location['travel_context'] ?? '';
        $shortDesc = $service['short_description'] ?? '';
        $intro = "Looking for {$targetKeyword}? DyWix Studio offers a premium, ready-to-shoot {$serviceName} setup designed for creators, founders, agencies, and businesses. {$shortDesc} Located centrally near Metro connectivity, our studio features high-end cameras, soundproofing, and custom lighting configurations. {$localIntro} {$travelContext} Contact us today to secure your booking slot and elevate your content quality.";

        // Generate sections
        $nearby = isset($location['nearby_areas']) ? implode(', ', array_slice($location['nearby_areas'], 0, 4)) : '';
        $sections = [
            'why_choose' => "DyWix Studio is the preferred choice for {$targetKeyword} because of our premium equipment and client comfort. Located in Dwarka Sector 13, we offer professional acoustic setups, high-power backup, changing areas, and experienced sound and visual technicians to help you capture flawless content for {$locationName}.",
            'what_is_included' => $service['included_features'] ?? [],
            'who_is_it_for' => $service['target_audience'] ?? [],
            'local_coverage' => "Our studio serves clients across {$locationName} and surrounding localities including {$nearby}. We provide easy transit options and dedicated parking grids.",
            'packages' => "We provide custom packages ranging from hourly slot rentals to full-day corporate campaigns. Standard edits, reels cutouts, and sound mixing can be bundled dynamically.",
            'use_cases' => $service['use_cases'] ?? []
        ];

        // Select localized FAQs
        $faqs = $this->selectAndLocalizeDynamicFaqs($service, $location);

        // Canonical URL
        $canonicalParent = $location['canonical_parent'] ?? null;
        $canonicalSlug = "{$service['slug']}-in-" . ($canonicalParent ?: $location['slug']);
        $canonicalUrl = config('dywix.base_url', 'https://www.dywix.com') . '/' . $canonicalSlug;

        // Build dynamic internal links
        $internalLinks = [
            '/' . $service['slug'] . '-in-delhi',
            '/' . $service['slug'] . '-in-dwarka',
            '/contact'
        ];

        // E-E-A-T trust signals (Experience, Expertise, Authoritativeness, Trustworthiness)
        $trustSignals = [
            'reviewed_by' => 'DyWix Studio Editorial Review Board',
            'verified_at' => date('Y-m-d'),
            'expert_author' => 'DyWix Studio Production Team',
            'rating_value' => '4.9',
            'review_count' => rand(85, 149),
            'badges' => ['Acoustically Treated', 'Cinema-grade Gear', 'Verified Creator Space', 'Power Backup Guaranteed']
        ];

        return [
            'id' => $slug,
            'slug' => $slug,
            'service_id' => $service['id'] ?? '',
            'location_id' => $location['id'] ?? '',
            'page_type' => 'programmatic-seo-landing-page',
            'target_keyword' => $targetKeyword,
            'search_intent' => 'local commercial',
            'seo_title' => substr($seoTitle, 0, 60),
            'meta_description' => substr($metaDesc, 0, 155),
            'h1' => $h1,
            'intro' => $intro,
            'sections' => $sections,
            'faqs' => $faqs,
            'internal_links' => $internalLinks,
            'schema_type' => 'LocalBusinessServiceFAQ',
            'priority' => $score,
            'indexable' => $indexable,
            'canonical_url' => $canonicalUrl,
            'trust_signals' => $trustSignals,
            'status' => 'published'
        ];
    }

    /**
     * Compute priority score.
     */
    protected function calculatePriorityScore(string $serviceId, int $servicePriority, string $locationId, int $locationPriority): int
    {
        $base = intval(round(($servicePriority + $locationPriority) / 2));
        if (str_contains($locationId, 'dwarka')) {
            $base += 2;
        } elseif (in_array($locationId, ['west-delhi', 'janakpuri', 'uttam-nagar', 'delhi-ncr', 'delhi'])) {
            $base += 1;
        }
        if (in_array($locationId, ['meerut'])) {
            $base -= 2;
        } elseif (in_array($locationId, ['faridabad', 'ghaziabad', 'greater-noida', 'raj-nagar-extension'])) {
            $base -= 1;
        }
        return max(1, min(10, $base));
    }

    /**
     * Localize FAQs at request-time.
     */
    protected function selectAndLocalizeDynamicFaqs(array $service, array $location): array
    {
        $locationName = $location['name'] ?? '';
        $serviceName = $service['name'] ?? '';
        return [
            [
                'question' => "Where can I book a {$serviceName} in {$locationName}?",
                'answer' => "You can book DyWix Studio in Dwarka Sector 13 for professional {$serviceName} with camera, lighting, microphone and technical support."
            ],
            [
                'question' => "Does DyWix Studio provide support for {$serviceName} clients from {$locationName}?",
                'answer' => "Yes, DyWix Studio supports clients from {$locationName} with complete recording gear, aesthetic sets, and post-production switching."
            ]
        ];
    }
}
