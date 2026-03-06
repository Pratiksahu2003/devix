@extends('layouts.app')

@section('title', 'Something Went Wrong | ' . config('company.brand'))

@section('meta')
    <meta name="description"
          content="An unexpected error occurred on {{ config('company.brand') }}. Please try again in a moment." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 text-center">
            <p class="text-sm font-semibold tracking-wide text-[var(--color-brand-lens-blue)] uppercase">
                Error 500
            </p>
            <h1 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-[var(--color-text-main)]">
                Something went wrong on our side
            </h1>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                We’re experiencing an unexpected issue and are working to resolve it.
                You can try again in a moment or reach out to our team if the problem continues.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <button type="button"
                        onclick="window.location.reload()"
                        class="inline-flex items-center justify-center rounded-full bg-[var(--color-brand-lens-blue)] px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-blue-700 transition">
                    Try Again
                </button>
                <a href="{{ route('pages.contact') }}"
                   class="inline-flex items-center justify-center rounded-full border border-[var(--color-border-subtle)] bg-white px-6 py-3 text-sm font-semibold text-[var(--color-text-main)] hover:bg-gray-50 transition">
                    Contact Support
                </a>
            </div>
        </div>
    </section>
@endsection

