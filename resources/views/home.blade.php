@extends('layouts.app')

@section('title', $pageTitle ?? config('company.brand').' | Premier Podcast & Content Studio in Delhi NCR')

@section('seo_head')
    @isset($seo)
        <x-seo.head :meta="$seo['meta']" :schema="$seo['schema_graph']" />
    @endisset
@endsection

@section('content')
    <x-home.hero />
    <x-home.services-marquee />
    <x-home.logos />
    <x-home.shop-by-frame />
    <x-home.studio-showcase />
    <x-home.featured-work :items="$featuredWorkItems" />
    <x-home.pricing />
    <x-home.testimonials />
    <x-home.cta-banner />
    <x-home.seo-hub-links />
    <x-home.contact />
@endsection
