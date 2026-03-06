@extends('layouts.app')

@section('title', 'Down for Maintenance | ' . config('company.brand'))

@section('meta')
    <meta name="description"
          content="{{ config('company.brand') }} is temporarily unavailable due to maintenance. Please check back soon." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 text-center">
            <p class="text-sm font-semibold tracking-wide text-[var(--color-brand-lens-blue)] uppercase">
                Error 503
            </p>
            <h1 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-[var(--color-text-main)]">
                We’re doing a quick upgrade
            </h1>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                {{ config('company.brand') }} is temporarily unavailable while we perform scheduled maintenance
                or an important update. We’ll be back online shortly.
            </p>

            <p class="mt-4 text-sm text-[var(--color-text-muted)]">
                If you have an urgent booking or production, please contact our team directly using the details below.
            </p>

            <div class="mt-8 space-y-2 text-sm text-[var(--color-text-muted)]">
                <p>
                    Phone:
                    <a href="tel:{{ config('company.phone.raw') }}"
                       class="text-[var(--color-brand-lens-blue)] hover:underline">
                        {{ config('company.phone.intl') }}
                    </a>
                </p>
                <p>
                    Email:
                    <a href="mailto:{{ config('company.email') }}"
                       class="text-[var(--color-brand-lens-blue)] hover:underline">
                        {{ config('company.email') }}
                    </a>
                </p>
            </div>
        </div>
    </section>
@endsection

