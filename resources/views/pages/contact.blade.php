@extends('layouts.app')

@section('title', 'Contact | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Contact {{ config('company.brand') }} in Delhi NCR to book the photography floor, videography studio, podcast setup or edit room for your next shoot." />
@endsection

@section('content')
    <x-home.contact />

    <section class="border-t border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">Find us on the map</h2>
            <p class="mt-2 text-sm text-[var(--color-text-muted)]">
                {{ implode(', ', array_filter(config('company.address.lines', []))) }} · {{ config('company.address.landmark') }}
            </p>
            <div class="mt-4 overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] shadow-sm">
                <div class="aspect-[16/9] w-full">
                    <iframe
                        title="Studio location map"
                        src="{{ config('company.map.embed_url') }}"
                        class="h-full w-full"
                        style="border:0;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen
                    ></iframe>
                </div>
                <div class="flex items-center justify-between border-t border-[var(--color-border-subtle)] bg-white px-4 py-2 text-[11px]">
                    <span class="text-[var(--color-text-muted)]">Directions powered by Google Maps</span>
                    <a href="{{ config('company.map.view_url') }}" target="_blank" class="inline-flex items-center gap-1 rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 font-medium hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">Open in Maps</a>
                </div>
            </div>
        </div>
    </section>
@endsection
