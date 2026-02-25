@extends('layouts.app')

@section('title', 'Studio Rules | '.config('company.brand'))

@section('meta')
    <meta name="description"
        content="Guidelines for using {{ config('company.brand') }}. Safety protocols, equipment handling, and code of conduct for a smooth production experience." />
@endsection

@section('content')
    <section class="bg-[var(--color-surface)] py-16 lg:py-24 border-b border-[var(--color-border-subtle)]">
        <div class="mx-auto max-w-4xl px-4 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-[var(--color-text-main)] sm:text-4xl">
                House Rules
            </h1>
            <p class="mt-4 text-lg text-[var(--color-text-muted)]">
                To ensure a safe and creative environment for everyone, we ask all teams to observe the following guidelines.
            </p>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-white">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 md:grid-cols-2">
                {{-- Respect & Time --}}
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">1</div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[var(--color-text-main)]">Respect the Clock</h3>
                            <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">
                                Your booking time includes load-in, setup, shooting, and load-out. Please arrive on time and begin wrapping up 15 minutes before your slot ends. Overtime is charged in hourly blocks.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">2</div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[var(--color-text-main)]">Leave it as you found it</h3>
                            <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">
                                Please return all equipment to its designated storage area. Fold cables neatly, dispose of trash in the provided bins, and leave the makeup area clean for the next team.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold">3</div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[var(--color-text-main)]">Sound Levels</h3>
                            <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">
                                Music is allowed at reasonable levels. However, please respect our neighbors and other building tenants. If recording audio, let us know so we can minimize disturbances.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Safety & Gear --}}
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center font-bold">4</div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[var(--color-text-main)]">Equipment Handling</h3>
                            <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">
                                Use sandbags on all light stands, especially when booming. If you are unsure how to operate a piece of gear, please ask the studio assistant. You are responsible for any damage caused by negligence.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center font-bold">5</div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[var(--color-text-main)]">No Smoking or Fire</h3>
                            <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">
                                Smoking, vaping, and open flames (candles, pyrotechnics) are strictly prohibited inside the studio. A designated smoking area is available outside the building.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center font-bold">6</div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[var(--color-text-main)]">Food & Drink</h3>
                            <p class="mt-2 text-sm text-[var(--color-text-muted)] leading-relaxed">
                                Please consume food and drinks in the lounge area only. Water bottles are allowed on set, but keep them capped and away from electrical equipment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16 rounded-2xl bg-[var(--color-surface-muted)] p-8 text-center">
                <p class="text-sm font-medium text-[var(--color-text-muted)]">
                    By booking with {{ config('company.brand') }}, you agree to these terms.
                </p>
                <div class="mt-6">
                    <a href="{{ route('pages.booking') }}" class="inline-flex items-center rounded-full bg-[var(--color-brand-lens-blue)] px-6 py-3 text-sm font-bold text-white shadow-md hover:bg-blue-700 transition">
                        I Agree, Let's Book
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
