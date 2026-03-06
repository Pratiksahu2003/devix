@extends('layouts.app')

@section('title', 'Access Denied | ' . config('company.brand'))

@section('meta')
    <meta name="description"
          content="You don’t have permission to access this page on {{ config('company.brand') }}." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 text-center">
            <p class="text-sm font-semibold tracking-wide text-[var(--color-brand-lens-blue)] uppercase">
                Error 403
            </p>
            <h1 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-[var(--color-text-main)]">
                You don’t have access to this page
            </h1>
            <p class="mt-4 text-[var(--color-text-muted)] leading-relaxed">
                This area is restricted or requires additional permissions. If you believe this is a mistake,
                please reach out to our team so we can help.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ url()->previous() ?: route('home') }}"
                   class="inline-flex items-center justify-center rounded-full bg-[var(--color-brand-lens-blue)] px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-blue-700 transition">
                    Go Back
                </a>
                <a href="{{ route('pages.contact') }}"
                   class="inline-flex items-center justify-center rounded-full border border-[var(--color-border-subtle)] bg-white px-6 py-3 text-sm font-semibold text-[var(--color-text-main)] hover:bg-gray-50 transition">
                    Contact Support
                </a>
            </div>
        </div>
    </section>
@endsection

