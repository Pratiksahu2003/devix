@extends('layouts.app')

@section('title', 'Privacy Policy | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="How {{ config('company.brand') }} collects, uses, and protects your personal data when you book a session or browse our site." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                Privacy Policy
            </h1>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                Last updated: {{ date('F Y') }}
            </p>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 prose prose-lg prose-slate text-[var(--color-text-muted)]">
            <p class="lead text-xl text-[var(--color-text-main)] font-medium">
                At {{ config('company.brand') }}, we respect your privacy and are committed to protecting the personal information you share with us.
            </p>

            <h3>1. Information We Collect</h3>
            <p>
                When you make a booking, inquire about our services, or subscribe to our newsletter, we may collect:
            </p>
            <ul>
                <li><strong>Personal Details:</strong> Name, email address, phone number.</li>
                <li><strong>Booking Information:</strong> Project details, dates, and team size.</li>
                <li><strong>Payment Data:</strong> Transaction IDs (we do not store full credit card numbers; payments are processed via secure third-party gateways).</li>
            </ul>

            <h3>2. How We Use Your Data</h3>
            <p>
                We use your information to:
            </p>
            <ul>
                <li>Process and confirm your studio bookings.</li>
                <li>Communicate regarding schedule changes or updates.</li>
                <li>Send invoices and receipts.</li>
                <li>Improve our studio services and website experience.</li>
            </ul>

            <h3>3. Data Sharing</h3>
            <p>
                We do not sell, trade, or rent your personal identification information to others. We may share generic aggregated demographic information not linked to any personal identification information regarding visitors and users with our business partners and advertisers.
            </p>

            <h3>4. Security</h3>
            <p>
                We implement appropriate data collection, storage, and processing practices and security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information.
            </p>

            <h3>5. Cookies</h3>
            <p>
                Our website may use "cookies" to enhance user experience. You may choose to set your web browser to refuse cookies or to alert you when cookies are being sent. If you do so, note that some parts of the site may not function properly.
            </p>

            <h3>6. Your Rights</h3>
            <p>
                You have the right to request access to the personal data we hold about you and to ask for it to be corrected or deleted. Please contact us at <a href="mailto:{{ config('company.email') }}">{{ config('company.email') }}</a> for any such requests.
            </p>

            <hr class="my-12 border-[var(--color-border-subtle)]">

            <p class="text-sm">
                By using this site, you signify your acceptance of this policy. If you do not agree to this policy, please do not use our site.
            </p>
        </div>
    </section>
@endsection
