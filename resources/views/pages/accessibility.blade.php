@extends('layouts.app')

@section('title', 'Accessibility Statement | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Our commitment to making {{ config('company.brand') }} accessible to all creators. Details on physical studio access and digital compliance." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                Accessibility Statement
            </h1>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                We believe creativity should be barrier-free.
            </p>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 prose prose-lg prose-slate text-[var(--color-text-muted)]">
            <p class="lead text-xl text-[var(--color-text-main)] font-medium">
                {{ config('company.brand') }} is committed to providing a workspace that is accessible to the widest possible audience, regardless of circumstance and ability.
            </p>

            <h3>Physical Access</h3>
            <p>
                Our studio is designed with accessibility in mind.
            </p>
            <ul>
                <li><strong>Elevator Access:</strong> The studio is located on the 4th floor and is serviced by a large freight elevator (8ft x 8ft) suitable for wheelchairs and heavy equipment.</li>
                <li><strong>Step-Free Entry:</strong> There is a ramp at the building entrance leading to the elevator lobby.</li>
                <li><strong>Restrooms:</strong> An accessible restroom is available on the same floor.</li>
                <li><strong>Parking:</strong> Reserved accessible parking spots can be arranged with prior notice.</li>
            </ul>

            <h3>Digital Accessibility</h3>
            <p>
                We aim to adhere to the Web Content Accessibility Guidelines (WCAG) 2.1 at the AA level. Our website features:
            </p>
            <ul>
                <li><strong>Semantic HTML:</strong> Proper use of headings, lists, and landmarks for screen readers.</li>
                <li><strong>Color Contrast:</strong> Text and UI elements meet minimum contrast ratios for readability.</li>
                <li><strong>Keyboard Navigation:</strong> All interactive elements are accessible via keyboard.</li>
                <li><strong>Alt Text:</strong> Images include descriptive alternative text.</li>
            </ul>

            <h3>Assistance</h3>
            <p>
                If you require any special assistance during your booking (e.g., help with load-in, specific seating arrangements), please let our team know in advance. We are happy to accommodate your needs to ensure a comfortable shoot.
            </p>

            <h3>Feedback</h3>
            <p>
                We are continuously learning and improving. If you encounter any barriers or have suggestions, please contact us at <a href="mailto:{{ config('company.email') }}">{{ config('company.email') }}</a>.
            </p>
        </div>
    </section>
@endsection
