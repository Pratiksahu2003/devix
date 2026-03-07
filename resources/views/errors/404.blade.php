@extends('layouts.app')

@section('title', 'Page Not Found | ' . config('company.brand'))

@section('meta')
    <meta name="description"
          content="The page you are looking for could not be found on {{ config('company.brand') }}." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 text-center">
            <p class="text-sm font-semibold tracking-wide text-[var(--color-brand-lens-blue)] uppercase">
                Error 404
            </p>
            <h1 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-[var(--color-text-main)]">
                We couldn’t find that page
            </h1>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                The page you tried to access may have been moved, deleted, or the link might be incorrect.
                You can go back to the homepage or explore our key studio pages below.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center rounded-full bg-[var(--color-brand-lens-blue)] px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-blue-700 transition">
                    Go to Homepage
                </a>
                <a href="{{ route('pages.contact') }}"
                   class="inline-flex items-center justify-center rounded-full border border-[var(--color-border-subtle)] bg-white px-6 py-3 text-sm font-semibold text-[var(--color-text-main)] hover:bg-gray-50 transition">
                    Contact Support
                </a>
            </div>
        </div>
    </section>

    <section class="py-12 lg:py-16 bg-white">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-lg font-semibold text-[var(--color-text-main)]">
                Helpful links
            </h2>
            <p class="mt-2 text-sm text-[var(--color-text-muted)]">
                Here are some quick links to get you back on track.
            </p>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <a href="{{ route('pages.photography') }}"
                   class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface)] p-4 hover:border-[var(--color-brand-lens-blue)] transition">
                    <p class="font-medium text-[var(--color-text-main)]">Photography Studio</p>
                    <p class="mt-1 text-sm text-[var(--color-text-muted)]">
                        Explore our photography sets, lighting, and creative spaces.
                    </p>
                </a>
                <a href="{{ route('pages.videography') }}"
                   class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface)] p-4 hover:border-[var(--color-brand-lens-blue)] transition">
                    <p class="font-medium text-[var(--color-text-main)]">Videography & Podcast</p>
                    <p class="mt-1 text-sm text-[var(--color-text-muted)]">
                        Learn about our video and podcast studio facilities.
                    </p>
                </a>
                <a href="{{ route('pages.pricing') }}"
                   class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface)] p-4 hover:border-[var(--color-brand-lens-blue)] transition">
                    <p class="font-medium text-[var(--color-text-main)]">Pricing & Packages</p>
                    <p class="mt-1 text-sm text-[var(--color-text-muted)]">
                        View studio rates, booking durations, and add-on services.
                    </p>
                </a>
                <a href="{{ route('pages.help') }}"
                   class="rounded-2xl border border-[var(--color-border-subtle)] bg-[var(--color-surface)] p-4 hover:border-[var(--color-brand-lens-blue)] transition">
                    <p class="font-medium text-[var(--color-text-main)]">Help Center & frequently Asked Questions</p>
                    <p class="mt-1 text-sm text-[var(--color-text-muted)]">
                        Find answers to common questions about {{ config('company.short_name') }}.
                    </p>
                </a>
            </div>
        </div>
    </section>
@endsection

