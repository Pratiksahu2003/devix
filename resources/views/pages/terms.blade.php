@extends('layouts.app')

@section('title', 'Terms & Conditions | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Terms of service for using {{ config('company.brand') }}. Liability, booking conditions, and usage rights." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                Terms & Conditions
            </h1>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                Last updated: {{ date('F Y') }}
            </p>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 prose prose-lg prose-slate text-[var(--color-text-muted)]">
            <p class="lead text-xl text-[var(--color-text-main)] font-medium">
                Welcome to {{ config('company.brand') }}. By booking our studio or using our services, you agree to comply with and be bound by the following terms and conditions.
            </p>

            <h3>1. Booking & Payment</h3>
            <p>
                All bookings are subject to availability. A deposit of 50% is required to secure your slot. The remaining balance is due before the start of your session. We reserve the right to cancel any booking if payment is not received in full.
            </p>

            <h3>2. Studio Use</h3>
            <p>
                The studio is to be used for photography, videography, and podcast recording purposes only. Any other use (events, parties, workshops) requires prior written consent. The renter is responsible for leaving the studio in the same condition as found.
            </p>

            <h3>3. Liability & Damage</h3>
            <p>
                {{ config('company.brand') }} is not liable for any injury, loss, or damage to personal property or equipment brought into the studio. The renter assumes full financial responsibility for any damage caused to studio equipment, furniture, or premises during their booking.
            </p>

            <h3>4. Overtime</h3>
            <p>
                Bookings begin and end at the scheduled times. Early arrival or late departure will be billed at our standard hourly overtime rate. Please plan your load-in and load-out accordingly.
            </p>

            <h3>5. Content & Conduct</h3>
            <p>
                We prohibit the production of illegal, pornographic, or hate speech content on our premises. We reserve the right to terminate a session immediately without refund if these terms are violated.
            </p>

            <h3>6. Governing Law</h3>
            <p>
                These terms are governed by the laws of India. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of the courts in New Delhi.
            </p>

            <hr class="my-12 border-[var(--color-border-subtle)]">

            <p class="text-sm">
                If you have any questions about these Terms, please contact us at <a href="mailto:{{ config('company.email') }}">{{ config('company.email') }}</a>.
            </p>
        </div>
    </section>
@endsection
