<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Static GET routes from web.php (page URLs only; excludes POST and /og).
     */
    private static function staticUrls(): array
    {
        $base = rtrim(URL::to('/'), '/');

        return [
            ['loc' => $base . '/', 'name' => 'home'],
            ['loc' => $base . '/photography-studio', 'name' => 'pages.photography'],
            ['loc' => $base . '/videography-studio', 'name' => 'pages.videography'],
            ['loc' => $base . '/podcast-studio', 'name' => 'pages.podcast'],
            ['loc' => $base . '/edit-room', 'name' => 'pages.edit-room'],
            ['loc' => $base . '/services', 'name' => 'pages.services'],
            ['loc' => $base . '/pricing', 'name' => 'pages.pricing'],
            ['loc' => $base . '/about', 'name' => 'pages.about'],
            ['loc' => $base . '/contact', 'name' => 'pages.contact'],
            ['loc' => $base . '/gallery', 'name' => 'pages.gallery'],
            ['loc' => $base . '/help', 'name' => 'pages.help'],
            ['loc' => $base . '/booking', 'name' => 'pages.booking'],
            ['loc' => $base . '/location', 'name' => 'pages.location'],
            ['loc' => $base . '/studio-specs', 'name' => 'pages.studio-specs'],
            ['loc' => $base . '/use-cases', 'name' => 'pages.use-cases'],
            ['loc' => $base . '/collaborations', 'name' => 'pages.collaborations'],
            ['loc' => $base . '/terms-and-conditions', 'name' => 'pages.terms'],
            ['loc' => $base . '/privacy-policy', 'name' => 'pages.privacy'],
            ['loc' => $base . '/cookie-policy', 'name' => 'pages.cookie-policy'],
            ['loc' => $base . '/accessibility', 'name' => 'pages.accessibility'],
            ['loc' => $base . '/studio-rules', 'name' => 'pages.studio-rules'],
            ['loc' => $base . '/cancellation-policy', 'name' => 'pages.cancellation'],
        ];
    }


    private function buildXml(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $entry) {
            $loc = htmlspecialchars($entry['loc'], ENT_XML1, 'UTF-8');
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$loc}</loc>\n";
            if (! empty($entry['lastmod'])) {
                $xml .= '    <lastmod>' . htmlspecialchars($entry['lastmod'], ENT_XML1, 'UTF-8') . "</lastmod>\n";
            }
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
