<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OgController extends Controller
{
    public function image(Request $request): Response
    {
        $title = trim((string) $request->query('title', config('company.brand')));
        $subtitle = trim((string) $request->query('subtitle', 'Rental podcast & content studio in Delhi NCR'));
        $title = mb_strimwidth($title, 0, 60, '…', 'UTF-8');
        $subtitle = mb_strimwidth($subtitle, 0, 80, '…', 'UTF-8');

        $svg = <<<SVG
<?xml version="1.0" encoding="UTF-8"?>
<svg width="1200" height="630" viewBox="0 0 1200 630" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="#004aad"/>
      <stop offset="100%" stop-color="#c89b3c"/>
    </linearGradient>
  </defs>
  <rect width="1200" height="630" fill="url(#g)"/>
  <rect x="24" y="24" width="1152" height="582" rx="28" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.35)"/>
  <text x="80" y="320" font-family="Montserrat,Segoe UI,Arial,sans-serif" font-size="72" font-weight="700" fill="#ffffff">
    {$this->escape($title)}
  </text>
  <text x="80" y="390" font-family="Montserrat,Segoe UI,Arial,sans-serif" font-size="32" fill="rgba(255,255,255,0.85)">
    {$this->escape($subtitle)}
  </text>
  <circle cx="1080" cy="120" r="30" fill="#ffffff"/>
  <text x="1067" y="130" font-family="Montserrat,Segoe UI,Arial,sans-serif" font-size="28" font-weight="700" fill="#004aad">{$this->escape(config('company.initials', 'DW'))}</text>
</svg>
SVG;

        return new Response($svg, 200, ['Content-Type' => 'image/svg+xml']);
    }

    private function escape(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
