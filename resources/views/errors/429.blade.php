@extends('layouts.app')

@section('title', 'Too Many Requests | ' . config('company.brand'))

@section('meta')
    <meta name="description"
          content="You’ve made too many requests in a short time on {{ config('company.brand') }}. Please try again later." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 text-center">
            <p class="text-sm font-semibold tracking-wide text-[var(--color-brand-lens-blue)] uppercase">
                Error 429
            </p>
            <h1 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-[var(--color-text-main)]">
                You’re going a bit too fast
            </h1>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                To keep our platform stable and secure, we limit how many requests can be made in a short period.
                Please wait a moment and then try again.
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

