<?php

namespace App\Services\Blog;

use App\Services\Seo\SeoDataService;
use App\Services\Seo\SeoUrlResolver;

class BlogContentBuilder
{
    public function __construct(
        protected SeoDataService $data,
        protected SeoUrlResolver $urls,
    ) {}

    public function build(array $blog): string
    {
        $service = $this->data->find('services', $blog['service'] ?? '') ?? [];
        $serviceSlug = $service['slug'] ?? 'podcast-studio';
        $serviceName = $service['name'] ?? 'Studio Production';
        $brand = config('company.brand');
        $title = $blog['title'];
        $excerpt = $blog['excerpt'] ?? '';
        $category = $blog['category'] ?? 'creator';

        $parts = [
            $this->introBlock($title, $excerpt, $brand, $serviceName),
            $this->overviewBlock($title, $category, $serviceName, $brand),
            $this->deepDiveBlock($title, $category, $serviceName, $brand),
            $this->whyDelhiBlock($category, $serviceName, $brand),
            $this->processSection($service),
            $this->equipmentTable($service),
            $this->checklistTable($category, $serviceName),
            $this->pricingTable($serviceSlug, $serviceName),
            $this->platformSpecsTable($category, $serviceName),
            $this->mistakesBlock($category, $serviceName),
            $this->expertTipsBlock($category, $serviceName, $brand),
            $this->useCasesBlock($category, $serviceSlug, $serviceName),
            $this->keyTakeawaysBlock($title, $category, $serviceName, $brand),
            $this->locationBlock($serviceSlug, $serviceName),
            $this->relatedServicesBlock($serviceSlug),
            $this->internalLinksBlock($serviceSlug, $serviceName),
            $this->relatedArticlesBlock($blog),
            $this->faqSection($blog['faqs'] ?? []),
            $this->ctaBlock($brand, $serviceSlug),
        ];

        $html = implode("\n", array_filter($parts));

        return $html;
    }

    public function wordCount(string $html): int
    {
        return str_word_count(strip_tags($html));
    }

    protected function introBlock(string $title, string $excerpt, string $brand, string $serviceName): string
    {
        $booking = route('pages.booking');
        $resources = route('seo.resources');

        return <<<HTML
<p><strong>{$title}</strong> — {$excerpt} This in-depth guide is written and reviewed by the {$brand} production team at our Dwarka Sector 13 studio. We have completed more than 500 production days for podcasts, video, photography, and commercial shoots across Delhi NCR. Every recommendation below reflects real sessions with agencies, D2C brands, healthcare practices, legal firms, edtech companies, and independent creators — not generic internet advice.</p>
<p>Whether you are planning your first {$serviceName} session or optimising an existing workflow, this article covers strategy, equipment, pricing, location access, and actionable checklists. Bookmark this page and share it with your team before your next shoot. When you are ready to book, visit our <a href="{$booking}">online booking page</a> or explore the full <a href="{$resources}">studio resources hub</a> for city-specific guides and pricing pages.</p>
<p>Last updated: {$this->currentMonthYear()}. Content follows E-E-A-T principles: Experience from on-set work, Expertise from in-house engineers, Authoritativeness from verified studio operations, and Trustworthiness through transparent pricing and a physical address in Dwarka, Delhi.</p>
<p>This guide includes production checklists, equipment tables, pricing comparisons, platform export specifications, and an extensive FAQ section — designed as a single reference you can share with stakeholders, agencies, and talent before booking {$serviceName} time in Delhi NCR.</p>
HTML;
    }

    protected function overviewBlock(string $title, string $category, string $serviceName, string $brand): string
    {
        $paragraphs = $this->categoryParagraphs($category, $serviceName, $brand);
        $body = '';
        foreach ($paragraphs as $p) {
            $body .= '<p>'.$p.'</p>';
        }

        return "<h2>Complete Overview: {$title}</h2>\n{$body}";
    }

    protected function deepDiveBlock(string $title, string $category, string $serviceName, string $brand): string
    {
        $paragraphs = $this->deepDiveParagraphs($category, $serviceName, $brand);
        $body = '';
        foreach ($paragraphs as $p) {
            $body .= '<p>'.$p.'</p>';
        }

        return "<h2>In-Depth Guide: {$title}</h2>\n{$body}";
    }

    protected function whyDelhiBlock(string $category, string $serviceName, string $brand): string
    {
        $cities = $this->data->cities()->take(6);
        $cityLinks = $cities->map(fn ($c) => '<a href="'.$this->urls->url('city', 'podcast-studio', $c['slug']).'">'.$c['name'].'</a>')->implode(', ');

        return <<<HTML
<h2>Why {$serviceName} in Delhi NCR Matters in 2026</h2>
<p>Delhi NCR is India's largest content production market. Brands compete for attention on YouTube, Instagram, Spotify, LinkedIn, and OTT — and production quality is the fastest lever to stand out. Renting a professional studio eliminates the hidden costs of home setups: acoustic treatment, lighting rentals, camera gear, retakes from noise, and hours lost in post-production fixing avoidable problems.</p>
<p>{$brand} is centrally located in Dwarka, accessible from {$cityLinks}, and across the wider NCR. Creators and companies choose a single dedicated facility because batch production is faster: record four podcast episodes, shoot twenty Reels, or photograph fifty SKUs in one disciplined studio day instead of spreading work across unreliable locations.</p>
<p>From a search and discovery perspective, location-specific studio pages help your audience find you. Our <a href="{$this->urls->url('city', 'podcast-studio', 'delhi')}">Delhi</a>, <a href="{$this->urls->url('city', 'podcast-studio', 'noida')}">Noida</a>, and <a href="{$this->urls->url('city', 'podcast-studio', 'gurugram')}">Gurugram</a> hub pages include drive times, metro access, and local pricing — useful whether you are booking or researching options for your marketing team.</p>
<p>Professional studios also reduce risk for regulated industries. Healthcare, legal, finance, and edtech clients benefit from controlled environments, NDAs, consistent branding, and engineers who understand compliance-sensitive recordings. The studio becomes an extension of your brand — not a borrowed room with unpredictable acoustics.</p>
<p>Finally, studio rental converts capital expense into operational expense. Instead of purchasing ₹5–15 lakh in cameras, lights, mics, and acoustic treatment, you pay per session with everything included. For growing teams, that flexibility preserves cash flow while maintaining broadcast-quality output.</p>
HTML;
    }

    protected function processSection(array $service): string
    {
        $steps = $service['process'] ?? ['Book online', 'Arrive early', 'Shoot with support', 'Export files'];
        $rows = '';
        foreach ($steps as $i => $step) {
            $phase = match ($i) {
                0 => 'Pre-session',
                1 => 'Arrival',
                2 => 'Production',
                default => 'Delivery',
            };
            $rows .= '<tr><td>'.($i + 1).'</td><td>'.$phase.'</td><td>'.$step.'</td><td>15–120 min</td></tr>';
        }
        $name = $service['name'] ?? 'Studio Session';

        return <<<HTML
<h2>Step-by-Step {$name} Workflow</h2>
<p>Follow this workflow for every booking — it is the same process our team uses with enterprise clients and first-time creators. Preparation reduces overrun charges and ensures you leave with usable files.</p>
<table>
<thead><tr><th>Step</th><th>Phase</th><th>Action</th><th>Typical Duration</th></tr></thead>
<tbody>{$rows}</tbody>
</table>
<p>Before step one, send your shot list, talent names, wardrobe notes, and brand guidelines to our team. We pre-configure mics, lights, and camera positions so your clock starts on creative work — not cable sorting.</p>
<p>During production, an on-site engineer monitors audio levels, lighting ratios, and recording integrity. Ask for test recordings in the first ten minutes and approve before continuing. After the session, files export to your drive or cloud transfer — RAW for video, WAV for podcast, and high-res JPEG or TIFF for photography depending on your package.</p>
HTML;
    }

    protected function equipmentTable(array $service): string
    {
        $equipment = $service['equipment'] ?? ['Professional cameras', 'Studio lighting', 'Audio interface', 'Acoustic treatment'];
        $rows = '';
        foreach ($equipment as $item) {
            $rows .= '<tr><td>'.$item.'</td><td>Included in session</td><td>Pre-rigged by engineer</td><td>On request</td></tr>';
        }
        $name = $service['name'] ?? 'Studio';

        return <<<HTML
<h2>Equipment Included at Our {$name}</h2>
<p>Every booking includes core gear below. Add-ons such as extra cameras, teleprompter operator, or makeup artist are available — request them when booking.</p>
<table>
<thead><tr><th>Equipment</th><th>Standard Package</th><th>Setup</th><th>Add-on</th></tr></thead>
<tbody>{$rows}</tbody>
</table>
<p>We maintain and calibrate equipment weekly. Microphones are sanitised between sessions. Lighting colour temperature is matched to your camera profile before you arrive.</p>
HTML;
    }

    protected function pricingTable(string $serviceSlug, string $serviceName): string
    {
        $delhi = $this->urls->url('pricing', $serviceSlug, 'delhi');
        $noida = $this->urls->url('pricing', $serviceSlug, 'noida');
        $gurugram = $this->urls->url('pricing', $serviceSlug, 'gurugram');
        $pricing = route('pages.pricing');

        return <<<HTML
<h2>{$serviceName} Pricing Guide (Delhi NCR)</h2>
<p>Studio pricing depends on session length, crew, and deliverables. The table below shows typical starting ranges at {$this->brand()} — confirm exact quotes on our pricing pages or booking form.</p>
<table>
<thead><tr><th>Package</th><th>Duration</th><th>Best For</th><th>Starting From</th></tr></thead>
<tbody>
<tr><td>Hourly</td><td>1–3 hours</td><td>Quick interviews, headshots, single Reel</td><td>See <a href="{$delhi}">Delhi pricing</a></td></tr>
<tr><td>Half Day</td><td>4 hours</td><td>Podcast batch, product line, social bundle</td><td>See <a href="{$noida}">Noida pricing</a></td></tr>
<tr><td>Full Day</td><td>8 hours</td><td>Campaigns, catalog, multi-setup shoots</td><td>See <a href="{$gurugram}">Gurugram pricing</a></td></tr>
<tr><td>Edit Room</td><td>Hourly</td><td>Assembly cut, podcast edit, colour</td><td><a href="{$pricing}">Full rate card</a></td></tr>
</tbody>
</table>
<p>Half-day and full-day packages usually offer 20–35% better value than stacking hourly slots. Teams travelling from Noida, Gurugram, or Faridabad often book half-day minimum to justify commute time and setup.</p>
HTML;
    }

    protected function mistakesBlock(string $category, string $serviceName): string
    {
        $mistakes = match ($category) {
            'podcast' => [
                'Recording in untreated rooms with echo and HVAC noise',
                'Skipping headphones and discovering clipping after the guest leaves',
                'Ignoring room tone and making edits sound disjointed',
                'Publishing without loudness normalisation for Spotify/YouTube',
                'Choosing the wrong mic pattern for the room and voice',
            ],
            'photography' => [
                'Mixing colour temperatures from windows and strobes',
                'Skipping a shot list and forgetting hero angles',
                'Underexposing glossy packaging and losing label detail',
                'Not calibrating monitor or export profile for e-commerce',
                'Rushing styling before steam and lint checks',
            ],
            'video' => [
                'Shooting without storyboard or shot list',
                'Forgotten B-roll for transitions and cover edits',
                'Inconsistent white balance across multi-camera setups',
                'No slate or clap for audio sync in post',
                'Vertical framing ignored when delivery includes Reels',
            ],
            default => [
                'Underestimating setup time and rushing the creative block',
                'No backup recordings or duplicate camera angles',
                'Weak pre-production brief shared with the studio team',
                'Booking too little time for wardrobe or makeup changes',
                'Forgetting export specs required by the platform',
            ],
        };

        $list = '<ul>'.implode('', array_map(fn ($m) => '<li>'.$m.'</li>', $mistakes)).'</ul>';

        return <<<HTML
<h2>Common {$serviceName} Mistakes (and How to Avoid Them)</h2>
<p>After hundreds of sessions, these are the issues we see most often — from first-time creators and experienced agencies alike. Avoid them to save retake costs and post-production time.</p>
{$list}
<p>Our engineers flag these risks in your pre-session call. Arrive fifteen minutes early so we can run test recordings and fix problems before talent is on the clock.</p>
HTML;
    }

    protected function expertTipsBlock(string $category, string $serviceName, string $brand): string
    {
        $tips = match ($category) {
            'podcast' => [
                'Batch-record intros and outros separately for cleaner edits',
                'Use a dynamic mic if your room cannot be fully isolated',
                'Record 30 seconds of room tone before and after dialogue',
                'Film vertical cutaways for Shorts while cameras are rigged',
                'Export WAV masters before any compression',
                'Share episode timestamps with your editor the same day',
            ],
            'photography' => [
                'Shoot tethered for immediate client approval on set',
                'Bracket exposures for difficult reflective packaging',
                'Use grey card for colour accuracy on skin and product',
                'Pipeline SKUs by size to minimise lighting changes',
                'Capture lifestyle variants in the same session',
                'Deliver sRGB for web and Adobe RGB for print when needed',
            ],
            'video' => [
                'Lock script before shoot day — changes on set cost time',
                'Record three takes minimum for every key line',
                'Capture ambient sound for natural transitions',
                'Plan teleprompter speed with talent before rolling',
                'Shoot master wide, then punch in for coverage',
                'Hand off proxy files if agency edits off-site',
            ],
            'pricing' => [
                'Request itemised quotes comparing hourly vs half-day',
                'Ask what equipment is included vs rented extra',
                'Book edit room in the same visit to reduce file transfer',
                'Negotiate package rates for recurring monthly content',
                'Factor metro/drive time when comparing studios',
                'Confirm overtime policy before the session starts',
            ],
            'location' => [
                'Use Blue Line Dwarka Sector 13/14 for fastest metro access',
                'Arrive early for parking near Radisson Blu Dwarka',
                'Share your Google Maps pin with guests in advance',
                'Book slots outside rush hour if talent travels cross-city',
                'Ask about load-in access for large props or wardrobe',
                'Combine studio session with client meetings in Dwarka',
            ],
            default => [
                'Prepare a one-page brief: goal, audience, deliverables',
                'Bring water and snacks — long sessions need energy',
                'Assign one decision-maker on set to approve takes',
                'Wear solid colours on camera; avoid tight patterns',
                'Back up files to two locations before leaving',
                'Schedule publishing within 48 hours while momentum is high',
            ],
        };

        $list = '<ul>'.implode('', array_map(fn ($t) => '<li><strong>Tip:</strong> '.$t.'</li>', $tips)).'</ul>';
        $extraParagraphs = $this->expertExtraParagraphs($category, $serviceName, $brand);
        $extra = '';
        foreach ($extraParagraphs as $p) {
            $extra .= '<p>'.$p.'</p>';
        }

        return "<h2>Expert Tips from the {$brand} Team</h2>\n{$list}\n{$extra}";
    }

    protected function checklistTable(string $category, string $serviceName): string
    {
        $rows = match ($category) {
            'podcast' => [
                ['Script & guest brief', 'Send 48h before session', 'Producer', 'Required'],
                ['Mic check & headphones', 'First 10 minutes on set', 'Engineer', 'Required'],
                ['Room tone recording', '30 sec before/after dialogue', 'Engineer', 'Required'],
                ['Multi-cam framing', 'Wide + medium + vertical crop', 'Director', 'Recommended'],
                ['Loudness target', '-16 LUFS integrated stereo', 'Editor', 'Required'],
                ['Show notes & timestamps', 'Same day as recording', 'Host', 'Recommended'],
                ['RSS & platform upload', 'Within 7 days of edit', 'Producer', 'Required'],
                ['Shorts clip export', '9:16 from multi-cam master', 'Editor', 'Optional'],
            ],
            'photography' => [
                ['Shot list per SKU', 'Angles, hero, detail, lifestyle', 'Client', 'Required'],
                ['Colour calibration', 'Grey card + monitor profile', 'Photographer', 'Required'],
                ['Steam & lint pass', 'Before every hero shot', 'Stylist', 'Required'],
                ['Tethered review', 'Client approves on set', 'Photographer', 'Recommended'],
                ['sRGB export for web', 'JPEG high quality 80–90', 'Retoucher', 'Required'],
                ['Marketplace crop specs', 'Amazon / Flipkart safe zones', 'Retoucher', 'Required'],
                ['Backup RAW + selects', 'Two locations before leaving', 'Studio', 'Required'],
                ['Naming convention', 'SKU_colour_angle_v01', 'Producer', 'Recommended'],
            ],
            'video' => [
                ['Locked script & storyboard', 'Approved before shoot day', 'Client', 'Required'],
                ['Talent wardrobe', 'Solid colours, no tight patterns', 'Talent', 'Required'],
                ['B-roll shot list', 'Cutaways, hands, environment', 'Director', 'Required'],
                ['Audio slate / clap', 'Every scene for sync', 'Engineer', 'Required'],
                ['Three takes minimum', 'Key lines and CTAs', 'Director', 'Required'],
                ['Vertical master plan', 'Reels-safe framing if needed', 'DP', 'Recommended'],
                ['Proxy handoff', 'If agency edits off-site', 'Studio', 'Optional'],
                ['Caption & SRT export', 'Platform accessibility', 'Editor', 'Recommended'],
            ],
            default => [
                ['One-page creative brief', 'Goal, audience, deliverables', 'Client', 'Required'],
                ['Brand guidelines PDF', 'Logos, fonts, tone', 'Client', 'Required'],
                ['Booking confirmation', 'Date, duration, package', 'Studio', 'Required'],
                ['Arrival 15 min early', 'Setup without eating clock', 'Talent', 'Required'],
                ['On-set decision maker', 'One person approves takes', 'Client', 'Required'],
                ['Export spec sheet', 'Resolution, codec, aspect', 'Producer', 'Required'],
                ['File delivery method', 'Drive link or handoff drive', 'Studio', 'Required'],
                ['Publish within 48h', 'Momentum while content is fresh', 'Marketing', 'Recommended'],
            ],
        };

        $body = '';
        foreach ($rows as $row) {
            $body .= '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td></tr>';
        }

        return <<<HTML
<h2>{$serviceName} Production Checklist</h2>
<p>Use this checklist with your team before, during, and after every session. Print it or share in your production Slack channel — it prevents the most expensive mistakes we see on set.</p>
<table>
<thead><tr><th>Task</th><th>Detail</th><th>Owner</th><th>Priority</th></tr></thead>
<tbody>{$body}</tbody>
</table>
<p>Mark each row complete in your project tracker. Studios that follow structured checklists reduce retake rates by an estimated 30–40% compared to improvised sessions.</p>
HTML;
    }

    protected function platformSpecsTable(string $category, string $serviceName): string
    {
        $rows = match ($category) {
            'podcast' => [
                ['Spotify / Apple Podcasts', 'Stereo MP3 128–320 kbps', '-16 LUFS integrated', 'Cover 3000×3000 min'],
                ['YouTube (video podcast)', '1080p H.264', '-14 LUFS for video', '16:9 + optional 9:16 clips'],
                ['Instagram / Shorts', '9:16 vertical', 'Hook in first 2 sec', 'Under 90 sec per clip'],
                ['LinkedIn Audio/Event', '1080p or audio-only', 'Captions required', 'Square 1:1 optional'],
            ],
            'photography' => [
                ['Amazon India', 'Pure white RGB 255', 'Min 1000px longest side', 'No text on main image'],
                ['Flipkart / Myntra', 'sRGB JPEG', 'Multiple angles required', 'Lifestyle optional'],
                ['D2C website', 'WebP or JPEG', 'Retina 2× assets', 'Consistent aspect ratio'],
                ['Meta / Google Ads', '1:1 and 4:5 crops', 'High contrast hero', 'No excessive text'],
            ],
            'video' => [
                ['YouTube long-form', '1080p or 4K', 'Chapters in description', 'Custom thumbnail 1280×720'],
                ['Instagram Reels', '9:16, 1080×1920', 'Safe zone for UI', '15–90 sec typical'],
                ['Corporate website', 'MP4 H.264', 'Muted autoplay safe', 'Under 2 min hero'],
                ['LinkedIn', '1:1 or 16:9', 'Captions burned-in', 'Hook in first 3 sec'],
            ],
            default => [
                ['YouTube', '1080p minimum', 'Consistent branding', 'End screen CTA'],
                ['Instagram', '9:16 primary', 'Cover frame matters', 'Batch 5–10 per session'],
                ['Website / SEO', 'Compressed assets', 'Alt text on images', 'Internal links to hubs'],
                ['Email / CRM', 'Lightweight files', 'Thumbnail + link', 'Track CTR'],
            ],
        };

        $body = '';
        foreach ($rows as $row) {
            $body .= '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td></tr>';
        }

        $resources = route('seo.resources');

        return <<<HTML
<h2>Platform Export Specifications for {$serviceName}</h2>
<p>Delivering the wrong format forces rework. Align your shoot and export settings with platform requirements from day one. Our engineers configure cameras and export presets to match your distribution plan — share this table when briefing your editor.</p>
<table>
<thead><tr><th>Platform</th><th>Format</th><th>Audio / Quality</th><th>Notes</th></tr></thead>
<tbody>{$body}</tbody>
</table>
<p>For city-specific studio guides and pricing, browse our <a href="{$resources}">studio resources hub</a> — it links every service, location, and industry page in one directory.</p>
HTML;
    }

    protected function keyTakeawaysBlock(string $title, string $category, string $serviceName, string $brand): string
    {
        $takeaways = match ($category) {
            'podcast' => [
                'Treat audio quality as non-negotiable — listeners forgive video but not bad sound.',
                'Batch episodes in half-day blocks to amortise travel and setup.',
                'Record room tone and ISO tracks every session for cleaner edits.',
                'Plan Shorts clips during the same multi-cam podcast shoot.',
                'Normalise loudness to platform standards before publish.',
                'Link show notes to service and location pages for SEO.',
            ],
            'photography' => [
                'Lock lighting and colour before the first SKU — drift ruins catalogs.',
                'Shoot hero, detail, and lifestyle in one visit when possible.',
                'QC against marketplace specs before client handoff.',
                'Use tethered capture for faster on-set approvals.',
                'Name files with SKU conventions your marketplace expects.',
                'Batch steam, lint, and styling to keep pipeline moving.',
            ],
            'video' => [
                'Approve script and storyboard before shoot day — changes on set are expensive.',
                'Capture B-roll and room tone for every corporate project.',
                'Plan vertical and horizontal masters if social is in scope.',
                'Record three takes of every key line and CTA.',
                'Deliver platform-specific cuts from one shoot, not separate days.',
                'Burn captions or supply SRT for LinkedIn and silent autoplay.',
            ],
            default => [
                'Send a one-page brief 48 hours before every session.',
                'Book enough time for setup, wardrobe, and export — not just talent on camera.',
                'Use studio rental to standardise quality instead of patching home setups.',
                'Repurpose one shoot across YouTube, Reels, email, and blog embeds.',
                'Measure results and feed insights into the next pre-production call.',
                'Reserve peak-season slots early — Q4 fills quickly in Delhi NCR.',
            ],
        };

        $list = '<ul>'.implode('', array_map(fn ($t) => '<li>'.$t.'</li>', $takeaways)).'</ul>';
        $booking = route('pages.booking');
        $directory = route('seo.directory');

        return <<<HTML
<h2>Key Takeaways: {$title}</h2>
<p>If you read nothing else in this guide, internalise the summary below. Share it with your marketing lead, agency producer, or co-host before your next {$serviceName} session at {$brand}.</p>
{$list}
<p>Professional production is a compounding asset. Each session that follows a disciplined checklist makes the next one faster — templates, engineer familiarity, and preset exports accumulate. Teams that treat studio days as sacred batch windows outperform teams that squeeze recording between meetings in echoey offices.</p>
<p>Delhi NCR's competitive content landscape rewards consistency and technical excellence. Your audience compares you to national creators and global brands whether you like it or not. Closing the quality gap is often cheaper than increasing ad spend — especially when studio rental includes gear and expertise you would otherwise hire separately.</p>
<p>When you are ready to execute, <a href="{$booking}">book your session online</a>, browse the <a href="{$directory}">full studio directory</a> for every hub page, or call our Dwarka team for a custom package quote tailored to your {$category} workflow.</p>
HTML;
    }

    protected function useCasesBlock(string $category, string $serviceSlug, string $serviceName): string
    {
        $cases = match ($category) {
            'podcast' => [
                ['Founder interview series', 'Weekly thought leadership for LinkedIn and Spotify', 'Half-day batch, 4 episodes'],
                ['Legal / finance explainers', 'Compliance-friendly audio with NDAs on request', 'Hourly + edit room'],
                ['Healthcare patient education', 'Doctor-hosted episodes with teleprompter support', 'Full-day + B-roll'],
                ['Agency white-label', 'Multi-client podcast pipeline with labelled exports', 'Monthly package'],
            ],
            'photography' => [
                ['Amazon catalog launch', '50–200 SKUs, white background + infographics', 'Full-day SKU pipeline'],
                ['D2C lifestyle campaign', 'Model + product in same studio day', 'Half-day + retouch'],
                ['Fashion lookbook', 'Seasonal collection with makeup room', 'Full-day editorial'],
                ['Corporate headshots', '10–50 executives, consistent lighting', 'Half-day team block'],
            ],
            'video' => [
                ['Startup explainer', 'Script to final cut with motion-ready footage', 'Full-day + post'],
                ['Corporate testimonial', 'Client interviews + B-roll in one visit', 'Half-day'],
                ['TVC / ad film', 'Broadcast specs, multi-setup studio', 'Full-day + crew'],
                ['Training & LMS', 'Module series with teleprompter', 'Recurring package'],
            ],
            'location' => [
                ['Noida corporate teams', 'Drive to Dwarka, half-day minimum', 'Video + photo combo'],
                ['Gurugram agency shoots', 'Batch Reels for multiple clients', 'Full-day studio lock'],
                ['Delhi creator days', 'YouTube + podcast in one booking', 'Full-day batch'],
                ['Faridabad product brands', 'Catalog + lifestyle same session', 'Half-day'],
            ],
            'pricing' => [
                ['First-time creators', 'Hourly trial then half-day upgrade', 'Podcast or Reels'],
                ['Growing D2C brands', 'Monthly content retainer', 'Photo + video bundle'],
                ['Enterprise compliance', 'NDA, controlled access, labelled files', 'Custom quote'],
                ['Agencies', 'White-label studio time for client shoots', 'Package rates'],
            ],
            default => [
                ['Influencer batch days', '20+ Reels in one disciplined session', 'Full-day'],
                ['Course creators', 'Talking-head + screen overlay ready', 'Half-day'],
                ['Real estate / pro services', 'Authority content for local SEO', 'Hourly'],
                ['Edtech explainers', 'Chroma key + teleprompter', 'Half-day'],
            ],
        };

        $rows = '';
        foreach ($cases as $case) {
            $rows .= '<tr><td>'.$case[0].'</td><td>'.$case[1].'</td><td>'.$case[2].'</td></tr>';
        }

        $serviceUrl = $this->urls->url('service', $serviceSlug);

        return <<<HTML
<h2>Real {$serviceName} Use Cases We Produce Weekly</h2>
<p>These are representative projects from our Dwarka studio — not hypothetical examples. If your use case matches a row below, mention it when booking so we pre-configure the room.</p>
<table>
<thead><tr><th>Use Case</th><th>Typical Deliverable</th><th>Booking Pattern</th></tr></thead>
<tbody>{$rows}</tbody>
</table>
<p>See full service scope on our <a href="{$serviceUrl}">{$serviceName} hub page</a> including equipment lists, sample pricing, and FAQs.</p>
HTML;
    }

    protected function locationBlock(string $serviceSlug, string $serviceName): string
    {
        $locations = route('seo.locations');
        $guideDelhi = $this->urls->url('guide', $serviceSlug, 'delhi');
        $map = route('pages.location');

        return <<<HTML
<h2>Studio Location &amp; Travel from Across NCR</h2>
<p>{$this->brand()} is at {$this->address()}. We serve clients recording {$serviceName} from Delhi, New Delhi, Noida, Gurugram, Faridabad, Ghaziabad, and all major NCR localities.</p>
<p><strong>Metro:</strong> Dwarka Sector 13 or Sector 14 (Blue Line) — 8–12 minute walk or short auto ride.<br>
<strong>Parking:</strong> Available near Radisson Blu Hotel, Dwarka Sector 13.<br>
<strong>Drive times:</strong> Approximately 20–45 minutes from most NCR hubs depending on traffic.</p>
<p>Explore our <a href="{$locations}">full location hub</a> for city and locality pages, or read the <a href="{$guideDelhi}">{$serviceName} guide for Delhi</a>. For directions, see our <a href="{$map}">studio location page</a> with embedded map.</p>
HTML;
    }

    protected function internalLinksBlock(string $serviceSlug, string $serviceName): string
    {
        $cities = $this->data->cities()->take(5);
        $cityLinks = $cities->map(fn ($c) => '<li><a href="'.$this->urls->url('city', $serviceSlug, $c['slug']).'">'.$serviceName.' in '.$c['name'].'</a></li>')->implode('');
        $localities = $this->data->localities()->take(5);
        $localityLinks = $localities->map(fn ($l) => '<li><a href="'.$this->urls->url('locality', $serviceSlug, $l['slug']).'">'.$serviceName.' near '.$l['name'].'</a></li>')->implode('');
        $guides = $cities->take(3)->map(fn ($c) => '<li><a href="'.$this->urls->url('guide', $serviceSlug, $c['slug']).'">'.$serviceName.' guide — '.$c['name'].'</a></li>')->implode('');
        $pricing = $cities->take(3)->map(fn ($c) => '<li><a href="'.$this->urls->url('pricing', $serviceSlug, $c['slug']).'">'.$serviceName.' cost in '.$c['name'].'</a></li>')->implode('');

        return <<<HTML
<h2>Internal Resources &amp; Location Hubs</h2>
<p>Explore {$serviceName} pages across Delhi NCR. These hubs include drive times, metro access, pricing, FAQs, and booking links — useful for producers researching options and for SEO teams building internal link architecture.</p>
<h3>City Hubs</h3>
<ul>{$cityLinks}</ul>
<h3>Locality Pages</h3>
<ul>{$localityLinks}</ul>
<h3>Production Guides</h3>
<ul>{$guides}</ul>
<h3>Pricing by City</h3>
<ul>{$pricing}</ul>
<p>Return to the <a href="{$this->route('seo.resources')}">studio resources master hub</a> or browse the <a href="{$this->route('seo.directory')}">complete page directory</a> for industry-specific and landmark pages.</p>
HTML;
    }

    protected function relatedServicesBlock(string $currentSlug): string
    {
        $links = $this->data->services()
            ->reject(fn ($s) => $s['slug'] === $currentSlug)
            ->take(6)
            ->map(fn ($s) => '<li><a href="'.$this->urls->url('service', $s['slug']).'">'.$s['name'].'</a> — '.$s['short_description'].'</li>')
            ->implode('');

        return <<<HTML
<h2>Related Studio Services</h2>
<p>Many clients combine services in one production day — podcast audio in the morning, product photos at lunch, Reels in the afternoon. Explore related hubs:</p>
<ul>{$links}</ul>
HTML;
    }

    protected function relatedArticlesBlock(array $blog): string
    {
        $related = $this->data->blogs()
            ->filter(fn ($b) => ($b['slug'] ?? '') !== ($blog['slug'] ?? '') && ($b['category'] ?? '') === ($blog['category'] ?? ''))
            ->take(5);

        if ($related->isEmpty()) {
            $related = $this->data->blogs()
                ->filter(fn ($b) => ($b['slug'] ?? '') !== ($blog['slug'] ?? ''))
                ->take(5);
        }

        $links = $related->map(fn ($b) => '<li><a href="'.route('blog.show', $b['slug']).'">'.$b['title'].'</a></li>')->implode('');

        return <<<HTML
<h2>Related Articles</h2>
<p>Continue learning with these guides from the {$this->brand()} blog:</p>
<ul>{$links}</ul>
<p>Browse all posts on our <a href="{$this->route('blog.index')}">blog index</a> or filter by category from the blog homepage.</p>
HTML;
    }

    protected function faqSection(array $faqs): string
    {
        if (empty($faqs)) {
            return '';
        }

        $items = '';
        foreach ($faqs as $faq) {
            $q = htmlspecialchars($faq['q'] ?? '', ENT_QUOTES, 'UTF-8');
            $a = $faq['a'] ?? '';
            $items .= "<h3>{$q}</h3>\n<p>{$a}</p>\n";
        }

        return <<<HTML
<h2>Frequently Asked Questions</h2>
<p>Below are the most common questions our team answers before bookings. Each answer reflects current studio policy, equipment packages, and Delhi NCR access notes — updated regularly by our production desk. If yours is not listed, <a href="{$this->route('pages.contact')}">contact us</a> or <a href="{$this->route('pages.booking')}">book a consultation slot</a>.</p>
{$items}
HTML;
    }

    protected function ctaBlock(string $brand, string $serviceSlug): string
    {
        return <<<HTML
<h2>Book Your Session at {$brand}</h2>
<p>Ready to apply everything in this guide? Our studio is open 24×7 with engineers on call. Book online, call {$this->phone()}, or message us on WhatsApp. Explore <a href="{$this->urls->url('service', $serviceSlug)}">{$brand} {$this->serviceName($serviceSlug)}</a>, view <a href="{$this->route('seo.resources')}">all resources</a>, or check the <a href="{$this->route('seo.directory')}">full SEO directory</a> for every service and location page.</p>
HTML;
    }

    protected function deepDiveParagraphs(string $category, string $serviceName, string $brand): array
    {
        $shared = [
            "Scaling {$serviceName} in Delhi NCR requires treating production as a system — not a one-off event. The teams that win on YouTube, Instagram, and marketplaces run repeatable session templates: same studio, same engineer, same export presets, same publishing cadence. Variation belongs in creative hooks and offers, not in room acoustics or white balance.",
            "Budget planning should compare fully-loaded home production against studio rental. Home setups hide costs: gear depreciation, failed takes, neighbour noise, inconsistent lighting, and editor hours fixing problems that never occur in a treated room. Studio rental converts unpredictable capital expense into a known line item per session — valuable for finance teams approving marketing spend.",
            "Internal linking matters for discoverability. When you publish guides like this one, link to your service hub pages, city pages, and booking flow. We structure our blog the same way — every article connects to <a href=\"{$this->route('seo.resources')}\">studio resources</a>, location hubs, and service-specific pricing so readers and search engines understand site architecture.",
            "Accessibility and inclusivity improve reach. Captions on video, transcripts for podcasts, and alt text on product images are not optional extras — they expand audience and satisfy platform algorithms that reward complete metadata. Plan captioning and transcript workflows before shoot day so they are not forgotten in the publish rush.",
            "Analytics close the loop. After each batch session, review retention curves, episode drop-off, SKU conversion, and ad CTR. Bring those insights to your next pre-production call. {$brand} engineers adjust mic placement, lighting ratios, and framing based on what your data shows — tighter crops if mobile dominates, wider masters if YouTube watch time is the KPI.",
        ];

        $specific = match ($category) {
            'podcast' => [
                'Guest management separates amateur shows from professional ones. Send calendar invites with parking pins, wardrobe guidance, and a one-page episode outline 72 hours ahead. Offer water, breaks, and a quiet holding area — guests perform better when they are not rushed from traffic straight into headphones.',
                'Remote co-hosts can join via high-quality VoIP with local backup recording on each end. We route remote audio into the same mix bus as in-studio mics so levels match. Always record a local ISO track for the guest — internet dropouts are not recoverable from a single mixed bus.',
                'Monetisation paths include sponsorship reads, affiliate funnels, paid communities, and lead generation for services. Record modular ad slots and outros so you can swap sponsors without re-recording full episodes. Batch six sponsor reads in ten minutes at the end of a session.',
            ],
            'photography' => [
                'Reflective packaging — skincare, supplements, electronics — needs polarised light and careful angle control. Our product bay uses flags and diffusion to kill hot spots while keeping label text legible. Shooting glossy items on a kitchen table is the fastest way to blow a marketplace listing.',
                'Colour consistency across a catalog builds brand trust. Shoot all variants in one session under locked lighting so navy and midnight blue do not drift apart. Use a colour checker passport and apply the same profile batch-wide in post.',
                'Infographic and lifestyle images lift conversion when paired with white-background heroes. Plan infographic copy before the shoot — dimensions, claim text, and icon placement — so you capture any needed detail shots the same day.',
            ],
            'video' => [
                'Pre-visualisation saves hours on set. Even a simple slide deck storyboard aligns client, director, and talent on sequence. Mark talking-head vs B-roll vs screen capture segments so the engineer rigs once per block instead of resetting between every sentence.',
                'Corporate stakeholders often need approval chains. Shoot master takes plus safety takes, and deliver a same-day assembly cut if sign-off is time-sensitive. Our edit room can host your marketing lead for live trim sessions.',
                'Localisation multiplies ROI. One studio day can yield Hindi and English versions with swapped intros and on-screen text — same lighting, same framing, sequential teleprompter loads. Plan both scripts before arrival.',
            ],
            'pricing' => [
                'Compare quotes on total delivered value, not hourly rate alone. A cheaper room without engineer support often costs more after retakes and emergency edits. Ask whether mics, cameras, lights, and basic export are included or billed separately.',
                'Package economics favour batching. A full-day rate typically amortises setup across eight hours of production — record podcast episodes, shoot testimonials, and capture product stills in one visit instead of three separate half-day minimums.',
                'Tax and invoicing clarity helps agencies. We provide GST invoices with line items suitable for client rebilling. Retainer clients receive monthly usage summaries for forecasting.',
            ],
            'location' => [
                'Cross-city production teams should coordinate arrival windows around Delhi traffic patterns. Early morning and mid-afternoon slots often beat peak rush. Share live location with guests and book parking in advance during event weekends in Dwarka.',
                'Combining studio time with client meetings in West Delhi reduces travel fatigue. Many Noida and Gurugram teams schedule morning shoots and afternoon stakeholder reviews in the same corridor.',
                'Metro accessibility matters for talent without cars. Dwarka Sector 13 and 14 stations are walking distance from our facility — include metro directions in guest briefs to reduce no-shows.',
            ],
            'marketing' => [
                'Content marketing ROI improves when studio output feeds every channel from one batch. A single session can yield long-form YouTube, five Shorts, quote cards, blog embeds, and email hero images — if you plan repurposing before the shoot.',
                'Influencer campaigns need clear usage rights captured in talent releases. Our front desk can provide standard release templates; agencies should bring custom ones for brand clients.',
                'Paid social performance correlates with first-frame quality. Dark, noisy vertical video underperforms in auction dynamics. Studio-lit Reels start with an exposure advantage before creative testing even begins.',
            ],
            'equipment' => [
                'Microphone selection is room-dependent. Dynamic mics reject room noise in imperfect spaces; large-diaphragm condensers reward fully treated booths. Our engineers A/B options in your pre-session call based on voice timbre and show format.',
                'Lighting modifiers change mood faster than moving talent. Softboxes for flattering interviews, grids for product specular control, and negative fill for dramatic podcasts — we stock modifiers so you do not rent piecemeal.',
                'Camera sensor size affects depth-of-field storytelling. Full-frame separation behind talent reads “premium” for brand films; deeper depth-of-field helps e-commerce focus across entire product depth.',
            ],
            'creator' => [
                'Creator burnout often comes from daily setup teardown. Batch ten videos in one studio day, then take a week off editing — sustainable cadence beats daily chaos. Block calendar themes: education Monday batch, entertainment Wednesday batch.',
                'Thumbnail shoots deserve dedicated minutes. Capture exaggerated expressions and high-contrast frames while lights are hot — do not treat thumbnails as an afterthought screenshot from video frames.',
                'Community feedback loops belong in pre-production. Poll audiences on topics, then record answers in studio the same week momentum is high. Stale topics recorded months after polling underperform.',
            ],
            default => [
                'Cross-functional alignment prevents reshoots. Loop in legal, brand, and performance marketing before the shoot — not after the first cut. A fifteen-minute alignment call saves hours of revision cycles.',
                'File naming and folder hierarchy matter when agencies hand off to editors. Use consistent slugs: project_date_setup_take_version. Our export team labels deliverables to your spec on request.',
                'Post-publish distribution is half the battle. Schedule email, social, and paid amplification within 48 hours while the team still remembers session context and hook rationale.',
            ],
        };

        return array_merge($shared, $specific);
    }

    protected function expertExtraParagraphs(string $category, string $serviceName, string $brand): array
    {
        return match ($category) {
            'podcast' => [
                "If you are comparing {$serviceName} options in Delhi NCR, visit our <a href=\"{$this->urls->url('city', 'podcast-studio', 'delhi')}\">Delhi podcast studio hub</a> and <a href=\"{$this->urls->url('pricing', 'podcast-studio', 'delhi')}\">pricing page</a> for transparent rates. Book a trial hour before committing to a half-day batch — hear your voice in the room before your guest arrives.",
                'Seasonal content planning helps: festival episodes, budget-season finance shows, and admission-cycle edtech topics spike predictably. Reserve studio slots four weeks ahead for Q4 when corporate and creator demand peaks.',
            ],
            'photography' => [
                "High-volume SKU days need logistics: labelled bins per product line, dedicated styling table, and a runner managing steamers. {$brand} supports pipeline workflows — ask for our catalog shoot playbook when booking fifty or more SKUs.",
                'Marketplace rejection reasons are often technical: colour cast, insufficient pixels, prohibited text. We QC exports against Amazon India and Flipkart checklists before handoff.',
            ],
            'video' => [
                'Sound design elevates corporate video beyond talking heads. Capture room tone, ambient office sounds, and foley on set — even simple keyboard clicks make edits feel cinematic.',
                'Versioning for stakeholders: deliver a 60-second social cut, a 3-minute website hero, and a 12-minute internal training master from one shoot with planned breakpoints in the script.',
            ],
            default => [
                "Explore <a href=\"{$this->route('seo.locations')}\">all NCR location pages</a> to compare drive times from your office. {$brand} publishes honest access notes — metro, parking, and typical commute windows — so producers can schedule talent realistically.",
                'Document lessons learned after every session in a shared Notion or Google Doc: what worked, what to change, which export preset was final. Your future self and your agency partners will thank you.',
            ],
        };
    }

    protected function categoryParagraphs(string $category, string $serviceName, string $brand): array
    {
        $base = [
            "Understanding {$serviceName} starts with defining your audience and deliverables. Are you publishing weekly, launching a campaign, or building a catalog? Each goal implies different lighting, audio, framing, and post-production requirements. At {$brand}, we map your outcome first — then configure the studio.",
            "Pre-production is where professional results are won or lost. Share references, brand guidelines, scripts, and shot lists at least 48 hours before your session. Our team prepares lighting diagrams, mic choices, and camera settings in advance so you walk into a ready room.",
            "On session day, trust the engineer for levels and exposure while you focus on performance, styling, and direction. Ask for monitoring on headphones or a client monitor. Approve test clips before committing to long recordings.",
            "Post-production should be planned before the shoot. Know your export formats: 1080p or 4K, vertical or horizontal, WAV or MP3, sRGB JPEG or layered PSD. Delivering the wrong spec means rework — specify platforms upfront.",
            "Consistency builds audience trust. Viewers and listeners recognise your visual and audio signature over time. Studio rental makes consistency affordable because the room, mics, and lights stay the same every visit.",
            "Measure results after publish. Track watch time, retention, click-through, and conversion — then iterate hooks, thumbnails, and episode titles. Studio quality removes technical excuses so you can test creative variables honestly.",
            "Teams scaling content across Delhi NCR benefit from batch days. Record multiple podcasts, shoot a month of Reels, or photograph an entire SKU line in one disciplined schedule. Travel once, produce massively.",
            "Regulated industries — healthcare, legal, finance — need reliable, private environments. Our studio offers controlled access, NDAs on request, and engineers trained for sensitive recordings without background leakage.",
            "Agencies appreciate file organisation. We label takes, sync multi-cam angles, and export with slates where needed. Your editor receives predictable folder structures instead of chaotic dumps.",
            "Finally, treat studio rental as a partnership. The best outcomes come from collaboration between your creative lead and our technical team — not from treating the studio as a silent room rental.",
        ];

        $extra = match ($category) {
            'podcast' => [
                'Podcast audiences forgive average video but rarely forgive bad audio. Invest in room treatment and mic technique before cameras.',
                'Multi-camera podcast setups let you clip vertical highlights without a separate shoot. Plan wide, medium, and close shots in the same session.',
                'Distribution matters: Spotify, Apple Podcasts, YouTube, and RSS each have loudness and metadata norms — normalise to -16 LUFS integrated for stereo podcasts.',
            ],
            'photography' => [
                'E-commerce platforms penalise inconsistent white balance and soft images. Studio strobes with colour calibration beat window light for SKU work.',
                'Lifestyle photography sells emotion; white-background photography sells clarity. Shoot both if your funnel uses ads and product pages.',
                'Retouching costs scale with capture quality. Nail exposure and styling on set to reduce per-image edit time.',
            ],
            'video' => [
                'Corporate video ROI comes from clear scripting and strong B-roll — not just a good talking head.',
                'Green screen work demands even lighting and spill control. Our cyc wall is pre-lit for keying efficiency.',
                'Social cuts from long-form master saves 40–60% versus shooting vertical-only setups separately.',
            ],
            default => [],
        };

        return array_merge($base, $extra);
    }

    protected function brand(): string
    {
        return config('company.brand');
    }

    protected function address(): string
    {
        $lines = config('company.address.lines', ['Dwarka, Delhi']);

        return implode(', ', $lines);
    }

    protected function phone(): string
    {
        return config('company.phone.intl', '');
    }

    protected function route(string $name): string
    {
        return route($name);
    }

    protected function serviceName(string $slug): string
    {
        return $this->data->find('services', $slug)['name'] ?? 'Studio';
    }

    protected function currentMonthYear(): string
    {
        return now()->format('F Y');
    }
}
