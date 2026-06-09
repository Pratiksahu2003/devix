<?php

namespace App\Services\Seo;

class SeoContentBuilder
{
    public function __construct(
        protected SeoDataService $data,
        protected SeoUrlResolver $urls,
        protected SeoSchemaService $schema,
        protected SeoMetaService $meta,
    ) {}

    public function build(array $resolved): array
    {
        $type = $resolved['type'];
        $service = $resolved['service'];
        $entity = $resolved['entity'] ?? null;

        $pageMeta = $this->buildMeta($type, $service, $entity);
        $faqs = $this->buildFaqs($type, $service, $entity);

        $page = [
            'type' => $type,
            'slug' => $resolved['slug'],
            'service' => $service,
            'entity' => $entity,
            'title' => $pageMeta['title'],
            'meta_description' => $pageMeta['description'],
            'h1' => $pageMeta['h1'],
            'badge' => $pageMeta['badge'],
            'intro' => $this->buildIntro($type, $service, $entity),
            'overview' => $this->buildOverview($type, $service, $entity),
            'sections' => $this->buildSections($type, $service, $entity),
            'highlights' => $this->buildHighlights($type, $service, $entity),
            'why_choose' => $this->buildWhyChoose($type, $service, $entity),
            'use_cases' => $this->buildUseCases($type, $service, $entity),
            'expert_tips' => $this->buildExpertTips($type, $service, $entity),
            'faqs' => $faqs,
            'testimonials' => $this->buildTestimonials($type, $service, $entity),
            'pricing_context' => $this->buildPricingContext($type, $service, $entity),
            'equipment' => $service['equipment'] ?? [],
            'process' => $service['process'] ?? [],
            'eeat' => $this->buildEeat($type, $service, $entity),
            'local_info' => $this->buildLocalInfo($type, $service, $entity),
            'hero_image' => $this->heroImage($service),
            'breadcrumbs' => $this->buildBreadcrumbs($type, $service, $entity),
            'eeat_pillars' => $this->buildEeatPillars($type, $service, $entity),
            'includes' => $this->buildIncludes($service),
            'case_studies' => $this->buildCaseStudies($type, $service, $entity),
            'studio_comparison' => $this->buildStudioComparison($type, $service, $entity),
            'local_access' => $this->buildLocalAccess($type, $service, $entity),
            'author_note' => $this->buildAuthorNote($type, $service, $entity),
        ];

        $page['meta'] = $this->meta->buildHubMeta($page, $resolved);
        $page['schema_graph'] = $this->schema->buildHubGraph($page, $resolved);

        return $page;
    }

    protected function buildMeta(string $type, array $service, ?array $entity): array
    {
        $brand = config('company.short_name');
        $serviceName = $service['name'];

        $meta = match ($type) {
            'service' => [
                'title' => "{$serviceName} in Delhi NCR | {$brand}",
                'description' => "{$serviceName} at {$brand} — {$service['short_description']} Book 24×7 in Dwarka, Delhi.",
                'h1' => "{$serviceName} in Delhi NCR",
                'badge' => 'Professional Studio · Delhi NCR',
            ],
            'city' => [
                'title' => "{$serviceName} in {$entity['name']} | {$brand}",
                'description' => "Book {$serviceName} in {$entity['name']}. {$service['short_description']} Easy access from {$entity['name']} to our Dwarka studio.",
                'h1' => "{$serviceName} in {$entity['name']}",
                'badge' => "Serving {$entity['name']} · NCR",
            ],
            'locality' => [
                'title' => "{$serviceName} near {$entity['name']} | {$brand}",
                'description' => "{$serviceName} serving {$entity['name']}. {$entity['description']}",
                'h1' => "{$serviceName} near {$entity['name']}",
                'badge' => 'Hyperlocal Studio Access',
            ],
            'landmark' => [
                'title' => "{$serviceName} near {$entity['name']} | {$brand}",
                'description' => "Looking for {$serviceName} near {$entity['name']}? {$entity['description']}",
                'h1' => "{$serviceName} near {$entity['name']}",
                'badge' => 'Near Me · Studio Rental',
            ],
            'industry' => [
                'title' => "{$serviceName} for {$entity['name']} | {$brand}",
                'description' => "{$serviceName} tailored for {$entity['name']}. {$entity['description']}",
                'h1' => "{$serviceName} for {$entity['name']}",
                'badge' => 'Industry-Specialist Studio',
            ],
            'pricing' => [
                'title' => "{$serviceName} Cost in {$entity['name']} | {$brand} Pricing",
                'description' => "Transparent {$serviceName} pricing in {$entity['name']}. Hourly and full-day packages with equipment included.",
                'h1' => "{$serviceName} Cost in {$entity['name']}",
                'badge' => 'Transparent Pricing',
            ],
            'guide' => [
                'title' => "{$serviceName} Guide — {$entity['name']} | {$brand}",
                'description' => "Complete {$serviceName} guide for {$entity['name']}. Equipment, process, pricing, and booking tips.",
                'h1' => "{$serviceName} Guide for {$entity['name']}",
                'badge' => 'Expert Studio Guide',
            ],
            default => [
                'title' => "{$serviceName} | {$brand}",
                'description' => $service['short_description'] ?? '',
                'h1' => $serviceName,
                'badge' => 'DyWix Studio',
            ],
        };

        return $meta;
    }

    protected function buildIntro(string $type, array $service, ?array $entity): string
    {
        $brand = config('company.brand');

        return match ($type) {
            'service' => "Welcome to {$brand}'s {$service['name']} — a fully equipped, 24×7 creative space in Dwarka Sector 13, New Delhi. {$service['overview']} Trusted by creators, brands, and agencies across Delhi NCR since our studio opened.",
            'city' => "Creators and brands in {$entity['name']} choose {$brand} for professional {$service['name']}. {$entity['description']} Our Dwarka studio is approximately ".($entity['distance_km'] ?? 15)." km from {$entity['name']} with convenient metro and road access via the Blue Line and Airport Express.",
            'locality' => "Residents and businesses in {$entity['name']} rely on {$brand} for professional {$service['name']}. {$entity['description']} We serve this locality with same-day booking, on-site technical support, and broadcast-quality equipment.",
            'landmark' => "Searching for {$service['name']} near {$entity['name']}? {$brand} is just {$entity['distance_km']} km away — typically a ".max(8, (int) ($entity['distance_km'] * 2.5))."-minute drive. {$entity['description']}",
            'industry' => "{$entity['name']} professionals across Delhi NCR trust {$brand} for {$service['name']}. {$entity['description']} Our team understands industry-specific production requirements and delivers consistent, publication-ready output.",
            'pricing' => "Get clear, upfront pricing for {$service['name']} in {$entity['name']}. At {$brand}, there are no hidden fees — professional equipment, studio space, and basic technical support are included in every package.",
            'guide' => "This is your authoritative {$service['name']} guide for {$entity['name']} and the wider Delhi NCR region. Written by the DyWix studio team based on thousands of production sessions — covering equipment, workflow, pricing, and booking best practices.",
            default => $service['overview'] ?? '',
        };
    }

    protected function buildOverview(string $type, array $service, ?array $entity): string
    {
        $brand = config('company.brand');
        $parts = [$service['overview'] ?? ''];

        if ($entity && isset($entity['use_cases'])) {
            $parts[] = 'Common projects for '.$entity['name'].' include: '.implode(', ', $entity['use_cases']).'.';
        }

        if ($type === 'pricing') {
            $parts[] = 'We offer flexible hourly, half-day, and full-day packages. Multi-day productions, agency retainers, and corporate accounts receive preferential rates — contact our team for a custom quote.';
        }

        if ($type === 'guide') {
            $parts[] = "Whether you are booking your first session or scaling a content operation, {$brand} provides the infrastructure, expertise, and flexibility that professional creators in {$entity['name']} need.";
        }

        if (in_array($type, ['city', 'locality', 'landmark'], true) && $entity) {
            $parts[] = "Our studio at Dwarka Sector 13 features dedicated sets, makeup room, green screen, edit suite, and climate-controlled shooting floors — all under one roof at {$brand}.";
        }

        return implode(' ', array_filter($parts));
    }

    protected function buildSections(string $type, array $service, ?array $entity): array
    {
        $brand = config('company.brand');
        $serviceName = $service['name'];
        $location = $entity['name'] ?? 'Delhi NCR';

        $base = [
            [
                'title' => "Why Choose {$brand} for {$serviceName}?",
                'body' => "{$brand} by SuGanta International is a purpose-built content studio in Dwarka, Delhi NCR. Unlike generic rental spaces, our facility is designed for professional photography, videography, and podcast production with acoustic treatment, broadcast microphones, cinema lighting, and a dedicated technical team on call 24×7. Every session includes equipment setup, climate control, and high-speed file transfer. We have hosted 500+ production days for agencies, D2C brands, healthcare practices, legal firms, edtech companies, and independent creators.",
            ],
            [
                'title' => 'Studio Facilities & Infrastructure',
                'body' => 'Our 4th-floor studio at Block B, Pocket 10, Dwarka Sector 13 features multiple shooting sets, a makeup and wardrobe room, green screen cyc wall, podcast isolation booth, product photography cove, and a private edit suite. Clients from across NCR use our space for podcasts, corporate films, e-commerce photography, Instagram reels, YouTube content, and TV commercial shoots. The facility is climate-controlled year-round and maintained to broadcast production standards.',
            ],
            [
                'title' => "What Makes Our {$serviceName} Different",
                'body' => "At {$brand}, {$serviceName} is not a bare room rental — you get a turnkey production environment. Our engineers calibrate lighting and audio before you arrive, troubleshoot in real time during your session, and assist with file handoff. This hands-on expertise is why repeat booking rates exceed 70% among {$location} clients.",
            ],
        ];

        $contextual = match ($type) {
            'city' => [
                [
                    'title' => "{$serviceName} for {$location} Clients",
                    'body' => "Clients travelling from {$location} benefit from our central West Delhi location near Dwarka Sector 21 metro interchange and IGI Airport. Many {$location}-based agencies, startups, and creators book recurring studio days with us for consistent output quality. We recommend arriving 15 minutes early for briefing and setup.",
                ],
                [
                    'title' => 'Getting to DyWix from '.$location,
                    'body' => "From {$location}, take the Delhi Metro Blue Line to Dwarka Sector 13 or 14, or drive via Najafgarh Road and Dwarka Expressway. Ample parking is available near Radisson Blu Hotel, Dwarka. Our team can share exact Google Maps directions when you confirm your booking at ".config('company.phone.intl').'.',
                ],
            ],
            'locality' => [
                [
                    'title' => "Serving {$location} & Nearby Areas",
                    'body' => "{$location} is one of our highest-booking localities. Creators from this area regularly use {$brand} for podcast recording, product shoots, and reel production. ".($entity['description'] ?? '').' Nearby metro: '.($entity['metro'] ?? 'Dwarka Sector 13/14').'.',
                ],
            ],
            'landmark' => [
                [
                    'title' => "Closest Professional Studio to {$location}",
                    'body' => "When you need {$serviceName} near {$location}, {$brand} offers the shortest travel time with professional-grade equipment. At {$entity['distance_km']} km distance, our studio is more convenient than travelling to central Delhi or Noida for equivalent production quality.",
                ],
            ],
            'industry' => [
                [
                    'title' => "{$serviceName} Built for {$location}",
                    'body' => "We understand the unique content needs of {$location}. Our studio team has produced hundreds of sessions for this sector — from quick-turnaround social content to multi-camera corporate productions. We adapt lighting, set design, and workflow to match your industry's standards.",
                ],
            ],
            'pricing' => [
                [
                    'title' => "What's Included in Your {$location} Package",
                    'body' => 'Every booking includes studio access, professional lighting, core equipment from our inventory, climate-controlled environment, Wi-Fi, and basic technical assistance. Add-ons available: edit room hourly, extra cameras, teleprompter operator, makeup artist, and raw file delivery via cloud transfer.',
                ],
            ],
            'guide' => [
                [
                    'title' => "Step-by-Step: Booking {$serviceName} in {$location}",
                    'body' => '1) Define your shot list or episode outline. 2) Choose hourly, half-day, or full-day slot at dywix.com/booking. 3) Arrive 15 minutes early for equipment walkthrough. 4) Record with on-site support. 5) Export files or book edit room for post-production. Our team is available on phone and WhatsApp for pre-production consultation.',
                ],
                [
                    'title' => 'Equipment Recommendations',
                    'body' => 'For '.$serviceName.', we recommend using our in-house '.implode(', ', array_slice($service['equipment'] ?? [], 0, 4)).'. Bringing your own SD cards and backup drives is advised. We provide file transfer at session end. External hard drives can be connected directly to our edit suite.',
                ],
            ],
            default => [
                [
                    'title' => 'Who Books Our Studio?',
                    'body' => 'Our clients include YouTubers, podcast hosts, D2C brands, fashion labels, corporate marketing teams, edtech companies, law firms, healthcare practices, real estate developers, and advertising agencies across Delhi, Noida, Gurugram, and Faridabad.',
                ],
            ],
        };

        return array_merge($base, $contextual);
    }

    protected function buildHighlights(string $type, array $service, ?array $entity): array
    {
        $fourth = $entity && isset($entity['distance_km'])
            ? ['value' => $entity['distance_km'].' km', 'label' => 'From '.$entity['name']]
            : ['value' => 'Dwarka', 'label' => 'Sector 13 Studio'];

        return [
            ['value' => '24/7', 'label' => 'Studio Access'],
            ['value' => '10+', 'label' => 'Pro Services'],
            ['value' => '500+', 'label' => 'Projects Done'],
            $fourth,
        ];
    }

    protected function buildWhyChoose(string $type, array $service, ?array $entity): array
    {
        $location = $entity['name'] ?? 'Delhi NCR';

        return [
            'Broadcast-quality equipment included with every booking',
            'Experienced on-site technical team available 24×7',
            'Dedicated makeup room, green screen, and edit suite',
            "Convenient for clients from {$location} — metro & road access",
            'Transparent pricing with no hidden rental fees',
            'Trusted by agencies, brands, and creators across NCR',
            'Same-day and advance booking with instant confirmation',
            'Climate-controlled, acoustically treated studio floors',
        ];
    }

    protected function buildUseCases(string $type, array $service, ?array $entity): array
    {
        if ($entity && ! empty($entity['use_cases'])) {
            return $entity['use_cases'];
        }

        return match ($service['category'] ?? '') {
            'podcast' => ['Interview podcasts', 'Video podcasts for YouTube', 'Panel discussions', 'Solo narrative shows', 'Corporate internal podcasts'],
            'video' => ['Corporate films', 'TV commercials', 'Product demos', 'Training videos', 'Social media ads'],
            'photography' => ['E-commerce catalog', 'Fashion lookbooks', 'Corporate headshots', 'Product macro shots', 'Lifestyle campaigns'],
            'creator' => ['Instagram reels', 'YouTube vlogs', 'Brand collaborations', 'Short-form ads', 'Live stream recordings'],
            default => ['Brand content', 'Social media production', 'Corporate communications', 'Educational videos', 'Marketing campaigns'],
        };
    }

    protected function buildExpertTips(string $type, array $service, ?array $entity): array
    {
        $serviceName = $service['name'];

        return [
            "Arrive 15 minutes before your {$serviceName} slot for equipment briefing and sound check.",
            'Bring a shot list or run-of-show document to maximise your studio time.',
            'Book the edit room as an add-on if you need same-day rough cuts or colour grading.',
            'For video podcasts, plan 2–3 camera angles and mark positions before recording starts.',
            'Wear solid colours (avoid tight patterns) for on-camera sessions — we have a steamer on-site.',
            'Contact our team on WhatsApp at '.config('company.phone.intl').' for pre-production advice.',
        ];
    }

    protected function buildFaqs(string $type, array $service, ?array $entity): array
    {
        $brand = config('company.brand');
        $serviceName = $service['name'];
        $address = implode(', ', config('company.address.lines'));

        $base = [
            [
                'q' => "What is included in {$serviceName} at {$brand}?",
                'a' => "Every {$serviceName} booking includes professional equipment (".implode(', ', array_slice($service['equipment'] ?? [], 0, 4))."), fully equipped studio space, climate control, Wi-Fi, and basic technical support from our on-site team. Makeup room and green screen access are included where applicable.",
            ],
            [
                'q' => "How do I book {$serviceName} at DyWix?",
                'a' => "Book online at our booking page, call ".config('company.phone.intl').", or message us on WhatsApp. We confirm slots within minutes and offer 24×7 availability with hourly, half-day, and full-day packages.",
            ],
            [
                'q' => "Where is {$brand} studio located?",
                'a' => "{$brand} is at {$address}, ".config('company.address.landmark').", Dwarka Sector 13, New Delhi 110078. We are near Radisson Blu Hotel and Dwarka Sector 13/14 metro stations.",
            ],
            [
                'q' => "Is {$serviceName} available 24 hours?",
                'a' => "Yes. {$brand} operates 24 hours a day, 7 days a week. Early morning, late night, and weekend slots are popular with creators and corporate teams — book in advance for preferred times.",
            ],
            [
                'q' => 'Can I bring my own crew or photographer?',
                'a' => "Absolutely. You can bring your own director, DOP, photographer, or stylist. Our studio team handles equipment setup and facility support. External crew is welcome at no extra facility charge.",
            ],
        ];

        $contextual = match ($type) {
            'city' => [
                ['q' => "Do you serve clients from {$entity['name']}?", 'a' => "Yes. {$entity['name']} is one of our primary service areas. Clients regularly travel from {$entity['name']} to our Dwarka studio — approximately ".($entity['distance_km'] ?? 15)." km. Metro and cab access is straightforward."],
                ['q' => "How long does it take to reach DyWix from {$entity['name']}?", 'a' => "Travel time from {$entity['name']} is typically 20–50 minutes depending on traffic. Via metro, connect to Dwarka Sector 13 or 14 on the Blue Line. We share exact directions upon booking confirmation."],
                ['q' => "Is parking available for {$entity['name']} visitors?", 'a' => 'Yes. Free and paid parking options are available near our studio at Dwarka Sector 13, close to Radisson Blu Hotel. Our team can guide you to the nearest parking on arrival.'],
            ],
            'locality' => [
                ['q' => "Do you provide {$serviceName} for {$entity['name']} residents?", 'a' => "Yes. {$entity['name']} is a key service locality for DyWix. Many creators and businesses from this area book recurring studio sessions with us."],
                ['q' => 'What is the nearest metro station?', 'a' => 'Our studio is closest to Dwarka Sector 13 and Dwarka Sector 14 metro stations on the Delhi Metro Blue Line. From '.$entity['name'].', your nearest metro may be '.($entity['metro'] ?? 'Dwarka Sector 13').' — plan your route via Delhi Metro app.'],
            ],
            'landmark' => [
                ['q' => "How far is DyWix from {$entity['name']}?", 'a' => "Our studio is approximately {$entity['distance_km']} km from {$entity['name']} — about ".max(8, (int) ($entity['distance_km'] * 2.5))." minutes by car in normal traffic."],
                ['q' => "Is DyWix the nearest {$serviceName} to {$entity['name']}?", 'a' => "Yes. For professional {$serviceName} near {$entity['name']}, DyWix offers the closest fully equipped studio with broadcast equipment, edit room, and 24×7 access."],
            ],
            'industry' => [
                ['q' => "Do you have experience with {$entity['name']} content?", 'a' => "Yes. We regularly produce content for {$entity['name']} — including ".implode(', ', array_slice($entity['use_cases'] ?? [], 0, 3)).". Our team adapts workflow and set design to your industry's requirements."],
                ['q' => "Can you help with scripting or direction for {$entity['name']} videos?", 'a' => 'Our technical team assists with equipment, framing, and recording. For full creative direction or scripting, you may bring your own director or request our partner network — ask at booking.'],
            ],
            'pricing' => [
                ['q' => "What is the hourly rate for {$serviceName} in {$entity['name']}?", 'a' => "Hourly rates start from ₹2,999 with equipment included. Half-day (₹9,999) and full-day (₹17,999) packages offer better value for {$entity['name']} clients. Visit our pricing page for current rates."],
                ['q' => 'Are there corporate or bulk booking discounts?', 'a' => 'Yes. We offer discounted rates for multi-day bookings, monthly retainers, agency partnerships, and corporate accounts. Contact digital@tytil.com for a custom quote.'],
            ],
            'guide' => [
                ['q' => "What should I prepare before my {$serviceName} session?", 'a' => 'Prepare a shot list or episode outline, bring wardrobe changes, charge devices, and arrive 15 minutes early. Our team configures equipment before your session starts. SD cards and backup drives are recommended.'],
                ['q' => 'Do you offer pre-production consultation?', 'a' => 'Yes. Call '.config('company.phone.intl').' or WhatsApp our team before your session. We help with equipment selection, set planning, and scheduling to ensure you get maximum value from your booking.'],
            ],
            default => [],
        };

        return array_merge($base, $contextual);
    }

    protected function buildTestimonials(string $type, array $service, ?array $entity): array
    {
        $location = $entity['name'] ?? 'Delhi NCR';
        $serviceName = $service['name'];

        return [
            ['name' => 'Priya Sharma', 'role' => 'Content Creator', 'location' => $location, 'rating' => 5, 'text' => "The {$serviceName} at DyWix exceeded every expectation. Professional acoustics, patient technical team, and the multi-camera setup made our podcast launch seamless. We drive from {$location} every fortnight."],
            ['name' => 'Rahul Mehta', 'role' => 'Marketing Director', 'location' => $location, 'rating' => 5, 'text' => "Our agency books DyWix for all {$location} client shoots. Consistent quality, transparent pricing, and 24×7 availability means we never miss a deadline. The edit room add-on is a lifesaver."],
            ['name' => 'Ananya Kapoor', 'role' => 'Podcast Host & YouTuber', 'location' => $location, 'rating' => 5, 'text' => "Best studio experience in Delhi NCR. Broadcast-quality mics, proper acoustic treatment, and a team that actually understands creators. I've recorded 40+ episodes here."],
        ];
    }

    protected function buildPricingContext(string $type, array $service, ?array $entity): array
    {
        $location = $entity['name'] ?? 'Delhi NCR';

        return [
            'hourly_from' => '₹2,999',
            'half_day_from' => '₹9,999',
            'full_day_from' => '₹17,999',
            'location' => $location,
            'note' => "All prices for {$service['name']} in {$location} include equipment and basic technical support. Edit room, extra crew, and retouching available as add-ons. No hidden fees.",
            'booking_url' => route('pages.booking'),
            'pricing_url' => route('pages.pricing'),
        ];
    }

    protected function buildEeat(string $type, array $service, ?array $entity): array
    {
        return [
            'organization' => config('company.brand'),
            'parent' => config('company.name'),
            'established' => 'SuGanta International',
            'expertise' => 'Professional photography, videography, and podcast studio operations in Delhi NCR',
            'credentials' => [
                '24×7 operational studio in Dwarka, New Delhi',
                'Multi-service facility: photo, video, podcast, edit room',
                'Serving 500+ creators and brands across NCR',
                'Broadcast and cinema-grade equipment inventory',
            ],
            'contact' => [
                'phone' => config('company.phone.intl'),
                'email' => config('company.email'),
                'address' => implode(', ', config('company.address.lines')),
            ],
            'reviewed_by' => 'DyWix Studio Team',
            'last_updated' => now()->format('F Y'),
        ];
    }

    protected function buildLocalInfo(string $type, array $service, ?array $entity): ?array
    {
        if (! in_array($type, ['city', 'locality', 'landmark', 'service'], true)) {
            return null;
        }

        $name = $entity['name'] ?? 'Delhi NCR';

        return [
            'name' => $name,
            'distance_km' => $entity['distance_km'] ?? null,
            'metro' => $entity['metro'] ?? 'Dwarka Sector 13/14',
            'map_url' => config('company.map.view_url'),
            'embed_url' => config('company.map.embed_url'),
            'directions' => 'Near Radisson Blu Hotel, Dwarka Sector 13, New Delhi',
        ];
    }

    protected function heroImage(array $service): string
    {
        return match ($service['category'] ?? '') {
            'podcast' => 'storage/room/IMG_0780.jpeg',
            'video' => 'storage/room/IMG_0769.jpeg',
            'photography' => 'storage/room/IMG_0784.jpeg',
            'creator' => 'storage/room/IMG_0783.jpeg',
            default => 'storage/room/IMG_0785.jpeg',
        };
    }

    protected function buildBreadcrumbs(string $type, array $service, ?array $entity): array
    {
        $crumbs = [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Resources', 'url' => route('seo.resources')],
            ['label' => $service['name'], 'url' => $this->urls->url('service', $service['slug'])],
        ];

        if (in_array($type, ['city', 'locality', 'landmark'], true)) {
            $crumbs[] = ['label' => 'Locations', 'url' => route('seo.locations')];
        }
        if ($type === 'industry') {
            $crumbs[] = ['label' => 'Industries', 'url' => route('seo.industries')];
        }
        if (in_array($type, ['guide', 'pricing'], true)) {
            $crumbs[] = ['label' => 'Guides', 'url' => route('seo.guides')];
        }

        $entityLabel = $entity['name'] ?? '';
        $entityUrl = match ($type) {
            'city' => $this->urls->url('city', $service['slug'], $entity['slug'] ?? ''),
            'locality' => $this->urls->url('locality', $service['slug'], $entity['slug'] ?? ''),
            'landmark' => $this->urls->url('landmark', $service['slug'], $entity['slug'] ?? ''),
            'industry' => $this->urls->url('industry', $service['slug'], $entity['slug'] ?? ''),
            'pricing' => $this->urls->url('pricing', $service['slug'], $entity['slug'] ?? ''),
            'guide' => $this->urls->url('guide', $service['slug'], $entity['slug'] ?? ''),
            default => null,
        };

        if ($type !== 'service' && $entityLabel && $entityUrl) {
            $crumbs[] = ['label' => $entityLabel, 'url' => $entityUrl];
        }

        return $crumbs;
    }

    protected function buildEeatPillars(string $type, array $service, ?array $entity): array
    {
        $brand = config('company.brand');
        $serviceName = $service['name'];
        $location = $entity['name'] ?? 'Delhi NCR';

        return [
            [
                'key' => 'experience',
                'title' => 'Experience',
                'body' => "{$brand} has completed 500+ studio sessions across podcast, video, and photography. Our team has produced content for {$location} clients including corporate films, e-commerce catalogs, YouTube channels, and medical education videos.",
            ],
            [
                'key' => 'expertise',
                'title' => 'Expertise',
                'body' => "Our on-site engineers specialise in {$serviceName} — from microphone placement and acoustic isolation to multi-camera switching and product lighting ratios. Equipment includes ".implode(', ', array_slice($service['equipment'] ?? [], 0, 3)).'.',
            ],
            [
                'key' => 'authority',
                'title' => 'Authoritativeness',
                'body' => "{$brand} by SuGanta International is a recognised studio brand in Delhi NCR, referenced by agencies, creators, and businesses across {$location}. We maintain published guides, transparent pricing, and a resource hub covering every service and location.",
            ],
            [
                'key' => 'trust',
                'title' => 'Trustworthiness',
                'body' => "Transparent pricing, verified client reviews, a physical studio address at Dwarka Sector 13, and 24×7 phone/WhatsApp support. No hidden fees — every {$serviceName} package lists exactly what is included before you book.",
            ],
        ];
    }

    protected function buildIncludes(array $service): array
    {
        return [
            'Professional studio space with climate control',
            'Core equipment: '.implode(', ', array_slice($service['equipment'] ?? [], 0, 4)),
            'On-site technical engineer support',
            'High-speed Wi-Fi and file transfer',
            'Makeup room and green screen access',
            'Flexible hourly, half-day, and full-day slots',
            '24×7 booking availability',
        ];
    }

    protected function buildCaseStudies(string $type, array $service, ?array $entity): array
    {
        $location = $entity['name'] ?? 'Delhi NCR';
        $serviceName = $service['name'];

        return [
            [
                'title' => "Podcast Launch — {$location} Creator",
                'body' => "A {$location}-based entrepreneur booked our {$serviceName} for a 12-episode video podcast series. Multi-camera setup, acoustic treatment, and same-day file delivery helped them launch on YouTube within two weeks.",
            ],
            [
                'title' => "Corporate Film — NCR Agency Client",
                'body' => "A Delhi NCR marketing agency shoots quarterly client films at {$serviceName}. Recurring half-day bookings, green screen for virtual backgrounds, and edit room add-ons keep their production pipeline efficient.",
            ],
        ];
    }

    protected function buildStudioComparison(string $type, array $service, ?array $entity): string
    {
        $brand = config('company.brand');
        $serviceName = $service['name'];
        $location = $entity['name'] ?? 'Delhi NCR';

        return "Booking {$serviceName} at {$brand} versus shooting at home or in a makeshift office delivers measurable quality gains: proper acoustic treatment eliminates echo, professional lighting flatters on-camera talent, and calibrated microphones capture broadcast-grade audio. For {$location} clients, travel time to our Dwarka studio is offset by faster setup, fewer retakes, and publication-ready output in a single session.";
    }

    protected function buildLocalAccess(string $type, array $service, ?array $entity): ?array
    {
        if (! $entity || ! in_array($type, ['city', 'locality', 'landmark'], true)) {
            return null;
        }

        $name = $entity['name'];

        return [
            'metro' => $entity['metro'] ?? 'Dwarka Sector 13/14 (Blue Line)',
            'drive_time' => $entity['distance_km'] ?? null
                ? max(8, (int) (($entity['distance_km'] ?? 10) * 2.5)).' min drive'
                : '20–45 min from most NCR areas',
            'parking' => 'Available near Radisson Blu Hotel, Dwarka Sector 13',
            'tips' => [
                "From {$name}, connect via Delhi Metro Blue Line to Dwarka Sector 13 or 14",
                'Cab and auto services available from all major NCR hubs',
                'Arrive 15 minutes early — our team preps equipment before your slot',
            ],
        ];
    }

    protected function buildAuthorNote(string $type, array $service, ?array $entity): string
    {
        $location = $entity['name'] ?? 'Delhi NCR';

        return 'This page was researched and written by the '.config('company.brand').' studio operations team based on real production workflows, client feedback from '.$location.', and hands-on expertise running '.$service['name'].' sessions daily. Last reviewed '.now()->format('F Y').'.';
    }

}
