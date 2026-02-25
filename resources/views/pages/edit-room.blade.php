@extends('layouts.app')

@section('title', 'Edit Room on Rent in Delhi NCR | '.config('company.brand'))

@section('content')
    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-14">
            <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">
                Edit Room on Rent
            </h1>
            <p class="mt-3 max-w-2xl text-sm leading-relaxed text-[var(--color-text-muted)]">
                A calm edit space with a Mac mini M2 Pro and 4K screen, so you can review, cut, and finish projects
                without leaving the studio – from social edits to full campaigns.
            </p>
        </div>
    </section>

    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">Designed for focused work</h2>
            <div class="mt-6 grid gap-8 md:grid-cols-2 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Hardware that keeps up</p>
                    <p>Mac mini M2 Pro with a calibrated 4K display offers a responsive timeline even with layered grades and multicam audio sync for podcasts and interviews.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Quiet, organized desk</p>
                    <p>Ergonomics and cable management reduce fatigue on long sessions. The room sits close to the floor so you can move between set and desk efficiently.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
            <h2 class="text-base font-semibold tracking-tight">Workflows we see most often</h2>
            <div class="mt-6 grid gap-8 lg:grid-cols-3 text-sm text-[var(--color-text-muted)]">
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">On‑set reviews</p>
                    <p>Check exposure, focus and continuity on a calibrated screen between setups, then carry those notes back to the floor for tighter, faster takes.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Social edits</p>
                    <p>Cut reels and shorts while the talent remains on set. You leave with approved cuts rather than to‑do lists that slow tomorrow’s deliverables.</p>
                </div>
                <div class="space-y-2">
                    <p class="font-medium text-[var(--color-text-main)]">Podcast assembly</p>
                    <p>Sync cameras and audio, trim pauses, lay simple grades and export previews before your guests leave the studio.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
