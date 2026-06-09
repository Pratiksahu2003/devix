<?php

namespace App\Services\Blog;

use App\Services\Seo\SeoDataService;

class BlogContentBuilder
{
    public function __construct(
        protected SeoDataService $data,
    ) {}

    public function build(array $blog): string
    {
        $title = $blog['title'];
        $excerpt = $blog['excerpt'] ?? '';
        $category = $blog['category'] ?? 'creator';
        $service = $this->data->find('services', $blog['service'] ?? '') ?? [];
        $serviceName = $service['name'] ?? 'Studio Production';
        $brand = config('company.brand');

        $sections = match ($category) {
            'podcast' => $this->podcastSections($title, $serviceName, $brand),
            'photography' => $this->photographySections($title, $serviceName, $brand),
            'video' => $this->videoSections($title, $serviceName, $brand),
            'pricing' => $this->pricingSections($title, $serviceName, $brand),
            'location' => $this->locationSections($title, $serviceName, $brand),
            'equipment' => $this->equipmentSections($title, $serviceName, $brand),
            'marketing', 'creator' => $this->creatorSections($title, $serviceName, $brand),
            default => $this->defaultSections($title, $excerpt, $serviceName, $brand),
        };

        $equipment = ! empty($service['equipment'])
            ? '<p>At our Dwarka studio, every session includes professional equipment such as <strong>'.implode('</strong>, <strong>', array_slice($service['equipment'], 0, 4)).'</strong>.</p>'
            : '';

        $cta = '<p>Ready to put this into practice? <a href="'.route('pages.booking').'">Book a session at '.$brand.'</a> or explore our <a href="'.route('seo.resources').'">studio resources hub</a> for location and pricing guides across Delhi NCR.</p>';

        return implode("\n", $sections).$equipment.$cta;
    }

    protected function podcastSections(string $title, string $serviceName, string $brand): array
    {
        return [
            '<p>'.$title.' — a practical guide from the '.$brand.' production team, based on 500+ podcast recording sessions at our Dwarka, Delhi NCR studio.</p>',
            '<h2>Why Studio Quality Matters for Podcasts</h2>',
            '<p>Home setups often suffer from room echo, inconsistent levels, and background noise. A purpose-built podcast studio with acoustic treatment, broadcast microphones, and an on-site engineer delivers broadcast-ready audio that retains listeners and ranks better on Spotify and YouTube.</p>',
            '<h2>What to Prepare Before Your Session</h2>',
            '<p>Bring your episode outline, guest questions, and any brand assets. Arrive 15 minutes early for mic placement and level checks. Our team handles multi-camera angles, teleprompter setup, and file export — so you focus on content, not cables.</p>',
            '<h2>Delhi NCR Podcast Production Tips</h2>',
            '<p>Creators across Delhi, Noida, and Gurugram choose a central Dwarka location for easy metro access. Batch-record multiple episodes in a single half-day slot to maximise studio value and keep your publishing calendar consistent.</p>',
        ];
    }

    protected function photographySections(string $title, string $serviceName, string $brand): array
    {
        return [
            '<p>'.$title.' — written by the '.$brand.' photography team with real shoot experience for e-commerce, fashion, and corporate clients in Delhi NCR.</p>',
            '<h2>Planning Your Shoot</h2>',
            '<p>Define your shot list, SKU count, and delivery format before booking. Product shoots benefit from infinity cove lighting and colour-calibrated workflows; fashion shoots need wardrobe prep and makeup room access — all available at our studio.</p>',
            '<h2>Lighting and Styling Essentials</h2>',
            '<p>Three-point lighting, softboxes, and reflectors shape how products and models appear on camera. Our photographers adjust ratios per category — glossy packaging needs different treatment than matte lifestyle products.</p>',
            '<h2>Delivery and Post-Production</h2>',
            '<p>We deliver retouch-ready files via cloud transfer. For high-volume catalog work, book a full-day slot and pipeline SKUs in batches to reduce per-image cost.</p>',
        ];
    }

    protected function videoSections(string $title, string $serviceName, string $brand): array
    {
        return [
            '<p>'.$title.' — insights from '.$brand.' video producers who handle corporate films, commercials, and social content daily.</p>',
            '<h2>Pre-Production Checklist</h2>',
            '<p>Lock your script, storyboard, and talent before shoot day. Green screen, teleprompter, and cinema lighting are pre-rigged at our studio — reducing setup time and keeping your budget on track.</p>',
            '<h2>On-Set Best Practices</h2>',
            '<p>Record room tone, capture B-roll, and shoot multiple takes for key lines. Our engineers monitor levels and camera sync so your edit team receives clean, organised files.</p>',
            '<h2>Post and Distribution</h2>',
            '<p>Book our edit room for same-day assembly cuts or hand off proxies to your agency. Vertical crops for Reels and Shorts can be captured in-studio with dedicated framing.</p>',
        ];
    }

    protected function pricingSections(string $title, string $serviceName, string $brand): array
    {
        return [
            '<p>'.$title.' — transparent pricing guidance from '.$brand.', a verified studio in Dwarka Sector 13 with published rates and no hidden fees.</p>',
            '<h2>What Affects Studio Cost</h2>',
            '<p>Session length, crew size, equipment add-ons, and edit room hours all influence total cost. Half-day and full-day packages typically offer better value than hourly bookings for multi-setup shoots.</p>',
            '<h2>Comparing Delhi NCR Options</h2>',
            '<p>Factor in travel time, equipment included, and engineer support when comparing studios. A lower hourly rate without mics, lights, or technical help often costs more once rentals are added.</p>',
            '<h2>Getting an Accurate Quote</h2>',
            '<p>Share your shot list, duration, and deliverables when requesting a quote. Our team responds with itemised pricing within one business day.</p>',
        ];
    }

    protected function locationSections(string $title, string $serviceName, string $brand): array
    {
        return [
            '<p>'.$title.' — location guide from '.$brand.', centrally based in Dwarka with easy access from across Delhi NCR.</p>',
            '<h2>Choosing the Right Studio Location</h2>',
            '<p>Proximity to metro lines, parking, and your team\'s base reduces no-shows and late arrivals. Our studio is near Dwarka Sector 13/14 Blue Line stations with parking near Radisson Blu Hotel.</p>',
            '<h2>What to Expect on Arrival</h2>',
            '<p>Check in at reception, meet your assigned engineer, and tour the shoot space before rolling. Climate-controlled rooms, high-speed Wi-Fi, and refreshments are standard for every booking.</p>',
            '<h2>Exploring NCR Studio Options</h2>',
            '<p>Browse our <a href="'.route('seo.locations').'">location hub</a> for city-specific pages with drive times, pricing, and service variants.</p>',
        ];
    }

    protected function equipmentSections(string $title, string $serviceName, string $brand): array
    {
        return [
            '<p>'.$title.' — equipment recommendations from engineers at '.$brand.' who configure mics, cameras, and lights for hundreds of sessions each year.</p>',
            '<h2>Choosing the Right Gear</h2>',
            '<p>Match equipment to your format — dynamic mics for noisy rooms, condensers for vocal clarity, LED panels for video interviews. Renting a fully equipped studio avoids capital expense and maintenance.</p>',
            '<h2>Setup and Calibration</h2>',
            '<p>Proper gain staging, mic placement, and white balance save hours in post. Our on-site team calibrates gear before your session starts.</p>',
        ];
    }

    protected function creatorSections(string $title, string $serviceName, string $brand): array
    {
        return [
            '<p>'.$title.' — creator playbook from the '.$brand.' team supporting YouTubers, influencers, and brand channels across India.</p>',
            '<h2>Content Strategy That Scales</h2>',
            '<p>Batch filming, repurposing long-form into Shorts, and maintaining a consistent visual style build audience trust. Studio days let you record a month of content in one focused session.</p>',
            '<h2>Production Workflow</h2>',
            '<p>Script → shoot → edit → publish. Reduce friction by using a studio with teleprompter, multi-camera, and export-ready files. Track metrics and iterate on hooks and thumbnails weekly.</p>',
        ];
    }

    protected function defaultSections(string $title, string $excerpt, string $serviceName, string $brand): array
    {
        return [
            '<p>'.$title.' — '.$excerpt.'</p>',
            '<p>This guide is produced by the '.$brand.' studio team at our Dwarka, Delhi NCR facility. We share practical advice drawn from real client projects across '.$serviceName.' and related services.</p>',
            '<h2>Key Takeaways</h2>',
            '<p>Plan ahead, use professional equipment, and leverage an experienced crew to save time in post-production. Our studio offers flexible hourly, half-day, and full-day bookings with transparent pricing.</p>',
        ];
    }
}
