@extends('layouts.app')

@section('title', 'Authentication Required | ' . config('company.brand'))

@section('meta')
    <meta name="description"
          content="You need to be signed in to access this page on {{ config('company.brand') }}." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 text-center">
            <p class="text-sm font-semibold tracking-wide text-[var(--color-brand-lens-blue)] uppercase">
                Error 401
            </p>
            <h1 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-[var(--color-text-main)]">
                Please sign in to continue
            </h1>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                This page is available only to authenticated users. If you already have access,
                try signing in again or returning to the homepage.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center rounded-full bg-[var(--color-brand-lens-blue)] px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-blue-700 transition">
                    Go to Homepage
                </a>
            </div>
        </div>
    </section>
@endsection

