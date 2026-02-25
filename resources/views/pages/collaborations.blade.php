@extends('layouts.app')

@section('title', 'Collaborations | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Partner with {{ config('company.brand') }}. We offer retainer models, priority booking, and co-production opportunities for agencies, brands, and high-volume creators." />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-white pt-16 pb-20 lg:pt-24 lg:pb-28">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                <div class="lg:col-span-6 text-center lg:text-left">
                    <span class="inline-flex items-center rounded-full bg-[var(--color-brand-lens-blue)]/10 px-3 py-1 text-sm font-medium text-[var(--color-brand-lens-blue)] mb-6">
                        Partnerships & Retainers
                    </span>
                    <h1 class="text-4xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-5xl lg:text-6xl mb-6">
                        Let’s Build a <br class="hidden lg:block">
                        <span class="text-[var(--color-brand-lens-blue)]">Creative Engine.</span>
                    </h1>
                    <p class="text-lg text-[var(--color-text-muted)] leading-relaxed mb-8">
                        We don’t just rent space; we partner with brands and agencies to build sustainable content workflows. Unlock exclusive rates, priority access, and production support.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#contact" class="inline-flex items-center justify-center rounded-full bg-[var(--color-brand-lens-blue)] px-8 py-3 text-sm font-bold text-white shadow-lg hover:bg-blue-700 transition">
                            Become a Partner
                        </a>
                        <a href="#models" class="inline-flex items-center justify-center rounded-full border border-gray-300 bg-white px-8 py-3 text-sm font-bold text-gray-700 hover:bg-gray-50 transition">
                            View Models
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-6 mt-12 lg:mt-0 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[4/3] rotate-2 hover:rotate-0 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="Team Collaboration" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-tr from-[var(--color-brand-lens-blue)]/20 to-transparent mix-blend-multiply"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Who We Work With --}}
    <section class="py-16 bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-[var(--color-text-main)]">Who We Collaborate With</h2>
                <p class="mt-4 text-[var(--color-text-muted)]">We build custom relationships based on volume and production needs.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                {{-- Agencies --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Creative Agencies</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        For agencies needing a reliable "home base" for multiple clients. We offer white-label production support and simplified billing.
                    </p>
                </div>

                {{-- D2C Brands --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">D2C Brands</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Consistent imagery is vital for conversion. Lock in a monthly slot for new drops, social content, and campaign shoots.
                    </p>
                </div>

                {{-- Production Houses --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[var(--color-border-subtle)] hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xl font-bold text-[var(--color-text-main)]">Production Houses</h3>
                    </div>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                        Need a secondary unit location or a specialized podcast set? We integrate seamlessly into your larger production logistics.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Partnership Models --}}
    <section id="models" class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <h2 class="text-3xl font-bold text-[var(--color-text-main)]">Partnership Models</h2>
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-6 w-6 rounded-full bg-[var(--color-brand-lens-blue)] flex items-center justify-center text-white text-xs font-bold">1</div>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold">Retainer Blocks</h4>
                            <p class="text-sm text-[var(--color-text-muted)] mt-1">
                                Purchase a bank of 50+ hours at our lowest rate. Use them flexibly over 3 months. Perfect for regular content needs.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-6 w-6 rounded-full bg-[var(--color-brand-lens-blue)] flex items-center justify-center text-white text-xs font-bold">2</div>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold">Volume Agreements</h4>
                            <p class="text-sm text-[var(--color-text-muted)] mt-1">
                                Committed to 4 shoots a month? We'll lock in your preferred dates and provide a dedicated account manager.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-6 w-6 rounded-full bg-[var(--color-brand-lens-blue)] flex items-center justify-center text-white text-xs font-bold">3</div>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold">Referral Program</h4>
                            <p class="text-sm text-[var(--color-text-muted)] mt-1">
                                Are you a photographer or stylist? Bring your clients to {{ config('company.brand') }} and earn commission or credit on bookings.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-3xl opacity-50 transform rotate-3"></div>
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=80" alt="Meeting" class="relative rounded-3xl shadow-lg w-full">
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Form --}}
    <section id="contact" class="py-16 lg:py-24 bg-[var(--color-surface)] border-t border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="p-8 lg:p-12">
                    <div class="text-center mb-10">
                        <h2 class="text-2xl font-bold text-[var(--color-text-main)]">Start a Conversation</h2>
                        <p class="mt-2 text-[var(--color-text-muted)]">Tell us about your organization and how you'd like to partner.</p>
                    </div>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="subject" value="Partnership Inquiry">
                        
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[var(--color-text-muted)] mb-2">Name</label>
                                <input type="text" name="name" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:border-[var(--color-brand-lens-blue)] focus:ring-[var(--color-brand-lens-blue)]" placeholder="Your name">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[var(--color-text-muted)] mb-2">Organization</label>
                                <input type="text" name="company" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:border-[var(--color-brand-lens-blue)] focus:ring-[var(--color-brand-lens-blue)]" placeholder="Agency / Brand">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[var(--color-text-muted)] mb-2">Email</label>
                            <input type="email" name="email" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:border-[var(--color-brand-lens-blue)] focus:ring-[var(--color-brand-lens-blue)]" placeholder="work@email.com">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[var(--color-text-muted)] mb-2">Partnership Interest</label>
                            <select name="interest" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:border-[var(--color-brand-lens-blue)] focus:ring-[var(--color-brand-lens-blue)]">
                                <option>Retainer / Bulk Hours</option>
                                <option>Agency Partnership</option>
                                <option>Referral Program</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[var(--color-text-muted)] mb-2">Message</label>
                            <textarea name="message" rows="4" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:border-[var(--color-brand-lens-blue)] focus:ring-[var(--color-brand-lens-blue)]" placeholder="Briefly describe your needs..."></textarea>
                        </div>

                        <button type="submit" class="w-full rounded-xl bg-[var(--color-brand-lens-blue)] py-4 text-sm font-bold text-white shadow-lg hover:bg-blue-700 transition">
                            Send Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
