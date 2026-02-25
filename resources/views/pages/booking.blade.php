@extends('layouts.app')

@section('title', 'Make a Booking | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Book your session at {{ config('company.brand') }}. Simple 3-step process, transparent rates, and full production support for your next shoot." />
@endsection

@section('content')
    {{-- Hero --}}
    <section class="relative bg-[var(--color-surface)] pt-16 pb-20 lg:pt-24 lg:pb-28 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-4xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-5xl">
                Book Your <span class="text-[var(--color-brand-lens-blue)]">Creative Space.</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-[var(--color-text-muted)]">
                From inquiry to wrap, we make the production process seamless. Check availability and lock in your dates today.
            </p>
        </div>
    </section>

    {{-- The Process Steps --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-[var(--color-text-main)]">How It Works</h2>
            </div>
            
            <div class="relative">
                {{-- Connector Line --}}
                <div class="absolute top-12 left-0 w-full h-0.5 bg-gray-100 hidden md:block"></div>
                
                <div class="grid gap-12 md:grid-cols-3 relative">
                    {{-- Step 1 --}}
                    <div class="relative bg-white p-6 text-center group">
                        <div class="mx-auto h-24 w-24 rounded-full bg-blue-50 border-4 border-white shadow-lg flex items-center justify-center mb-6 relative z-10 group-hover:scale-110 transition duration-300">
                            <span class="text-3xl font-bold text-[var(--color-brand-lens-blue)]">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Inquire & Brief</h3>
                        <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                            Fill out our booking form with your dates, team size, and equipment needs. The more detail, the better we can prep.
                        </p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="relative bg-white p-6 text-center group">
                        <div class="mx-auto h-24 w-24 rounded-full bg-blue-50 border-4 border-white shadow-lg flex items-center justify-center mb-6 relative z-10 group-hover:scale-110 transition duration-300">
                            <span class="text-3xl font-bold text-[var(--color-brand-lens-blue)]">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Confirm & Plan</h3>
                        <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                            We'll send a custom quote and call sheet. Confirm with a deposit, and we'll arrange any specific gear or set builds.
                        </p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="relative bg-white p-6 text-center group">
                        <div class="mx-auto h-24 w-24 rounded-full bg-blue-50 border-4 border-white shadow-lg flex items-center justify-center mb-6 relative z-10 group-hover:scale-110 transition duration-300">
                            <span class="text-3xl font-bold text-[var(--color-brand-lens-blue)]">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-main)] mb-3">Shoot & Create</h3>
                        <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">
                            Arrive to a pre-lit, clean studio. Our studio assistant will be on standby to help with grip, coffee, and troubleshooting.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Included Amenities --}}
    <section class="py-16 bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative rounded-3xl overflow-hidden shadow-xl aspect-video">
                    <img src="https://images.unsplash.com/photo-1517816428103-7dc308ec84d9?auto=format&fit=crop&w=800&q=80" alt="Studio Hospitality" class="h-full w-full object-cover">
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-[var(--color-text-main)] mb-6">Included in Every Booking</h2>
                    <p class="text-lg text-[var(--color-text-muted)] mb-8">
                        We don't nickel-and-dime for the basics. Every rental includes access to our core amenities to keep your team comfortable.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span class="text-sm font-medium">High-Speed Wi-Fi (1Gbps)</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span class="text-sm font-medium">Makeup & Styling Area</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span class="text-sm font-medium">Bluetooth Sound System</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span class="text-sm font-medium">Unlimited Coffee & Tea</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span class="text-sm font-medium">Private Changing Room</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            <span class="text-sm font-medium">Grip Package (Stands/Bags)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Add-ons Grid --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[var(--color-text-main)]">Production Add-ons</h2>
                <p class="mt-4 text-[var(--color-text-muted)]">Need extra hands or gear? We've got you covered.</p>
            </div>
            
            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl border border-[var(--color-border-subtle)] p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-lg text-[var(--color-text-main)]">Studio Assistant</h3>
                    <p class="text-xs font-semibold text-[var(--color-brand-lens-blue)] mt-1">₹1,500 / shift</p>
                    <p class="mt-3 text-sm text-[var(--color-text-muted)]">Hands-on help with lighting changes, set moves, and gear management.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-lg text-[var(--color-text-main)]">Camera Package</h3>
                    <p class="text-xs font-semibold text-[var(--color-brand-lens-blue)] mt-1">Starting ₹3,000</p>
                    <p class="mt-3 text-sm text-[var(--color-text-muted)]">Sony A7IV / FX3 bodies available with G-Master lens selection.</p>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] p-6 hover:shadow-lg transition">
                    <h3 class="font-bold text-lg text-[var(--color-text-main)]">Set Building</h3>
                    <p class="text-xs font-semibold text-[var(--color-brand-lens-blue)] mt-1">Custom Quote</p>
                    <p class="mt-3 text-sm text-[var(--color-text-muted)]">Custom backdrops, flats, or prop sourcing for stylized shoots.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Booking Form Component --}}
    <div id="form">
        <x-home.contact />
    </div>
@endsection
