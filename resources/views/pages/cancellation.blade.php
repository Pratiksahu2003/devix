@extends('layouts.app')

@section('title', 'Cancellation Policy | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Understand our cancellation and rescheduling policies. We offer flexible options for creative professionals while ensuring fair use of our studio calendar." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                Cancellation Policy
            </h1>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                We understand that production schedules can change. Here is how we handle cancellations and reschedules.
            </p>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            {{-- Policy Table --}}
            <div class="overflow-hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white shadow-sm mb-12">
                <table class="min-w-full divide-y divide-[var(--color-border-subtle)]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-[var(--color-text-main)]">Notice Period</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-[var(--color-text-main)]">Refund Amount</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-[var(--color-text-main)]">Reschedule Fee</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--color-border-subtle)] bg-white">
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">48+ Hours</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-green-600 font-bold">100% Refund</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">Free</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">24 - 48 Hours</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-orange-600 font-bold">50% Refund</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">25% of Booking Value</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">Less than 24 Hours</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-red-600 font-bold">No Refund</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">Full Re-booking Required</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="prose prose-lg prose-slate mx-auto text-[var(--color-text-muted)]">
                <h3>How to Cancel or Reschedule</h3>
                <p>
                    Please contact us immediately via email at <a href="mailto:{{ config('company.email') }}" class="text-[var(--color-brand-lens-blue)] font-medium">{{ config('company.email') }}</a> or call us at <strong>{{ config('company.phone.intl') }}</strong>. 
                    The notice period is calculated from the time we receive your written request.
                </p>

                <h3>Refund Processing</h3>
                <p>
                    Approved refunds are processed within 5-7 business days to the original payment method. If you paid via UPI, the refund will be credited to the same VPA.
                </p>

                <h3>Force Majeure</h3>
                <p>
                    In the event of unforeseen circumstances (natural disasters, severe weather, government lockdowns) that prevent the studio from operating, we will offer a full refund or a free reschedule regardless of the notice period.
                </p>
            </div>
        </div>
    </section>
@endsection
