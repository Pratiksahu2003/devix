<section id="contact" class="bg-[var(--color-surface-muted)]">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-14">
        <div class="grid gap-10 lg:grid-cols-2">
            <div class="space-y-4">
                <p class="text-[11px] font-medium uppercase tracking-[0.28em] text-[var(--color-text-muted)]">
                    reach out today
                </p>
                <h2 class="text-lg font-semibold tracking-tight sm:text-xl">
                    Let’s plan your next shoot.
                </h2>
                <p class="text-sm leading-relaxed text-[var(--color-text-muted)]">
                    Tell us about your project – portraits, campaigns, product drops, podcasts, or corporate films.
                    We’ll help you lock the perfect slot and setup.
                </p>
                <div class="grid gap-3 sm:grid-cols-2">
                    <a href="mailto:{{ config('company.email') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-2xl border border-[var(--color-border-subtle)] bg-white px-4 py-3 text-xs font-medium text-[var(--color-text-main)] shadow-sm transition hover:-translate-y-0.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">
                        <svg viewBox="0 0 24 24" class="h-4 w-4"><path fill="currentColor" d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4l-8 5L4 8V6l8 5l8-5Z"/></svg>
                        {{ config('company.email') }}
                    </a>
                    <a href="tel:{{ config('company.phone.raw') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-2xl border border-[var(--color-border-subtle)] bg-white px-4 py-3 text-xs font-medium text-[var(--color-text-main)] shadow-sm transition hover:-translate-y-0.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)]">
                        <svg viewBox="0 0 24 24" class="h-4 w-4"><path fill="currentColor" d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 .97-.26a11.36 11.36 0 0 0 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 7a1 1 0 0 1 1-1h2.5a1 1 0 0 1 1 1a11.36 11.36 0 0 0 .57 3.58a1 1 0 0 1-.26.97l-2.19 2.24Z"/></svg>
                        {{ config('company.phone.intl') }}
                    </a>
                </div>
                <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white p-4 text-[12px] text-[var(--color-text-muted)]">
                    <p>{{ implode(', ', array_filter(config('company.address.lines', []))) }} · {{ config('company.address.landmark') }}</p>
                    <a href="{{ config('company.map.view_url') }}" class="mt-1 inline-flex items-center gap-1 text-[11px] font-medium text-[var(--color-brand-lens-blue)]">
                        <span>Open in Maps</span>
                        <svg viewBox="0 0 24 24" class="h-3.5 w-3.5"><path fill="currentColor" d="M14 3h7v7h-2V6.41l-9.29 9.3l-1.42-1.42l9.3-9.29H14V3Z"/><path fill="currentColor" d="M5 5h5V3H3v7h2z"/><path fill="currentColor" d="M19 19h-5v2h7v-7h-2z"/></svg>
                    </a>
                </div>
            </div>

            @php
                $format = request()->query('format');
                $plan = request()->query('plan');
                $presetParts = [];
                if ($format) $presetParts[] = "format: {$format}";
                if ($plan) $presetParts[] = "plan: {$plan}";
                $presetSummary = $presetParts ? 'I’d like a quote for '.implode(', ', $presetParts).'. ' : '';
                $prefill = old('message') ?: ($presetSummary ? $presetSummary."My preferred dates are __ and my team size is __. Please share availability and recommendations." : '');
            @endphp
            @if (session('status'))
                <div class="rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-[12px] text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4 rounded-2xl border border-[var(--color-border-subtle)] bg-white p-5 shadow-sm shadow-black/5">
                @csrf
                <input type="hidden" name="_start_ts" value="{{ time() }}">
                <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">
                <input type="text" name="_token_check" value="" class="hidden" tabindex="-1" autocomplete="off">
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-medium uppercase tracking-[0.16em] text-[var(--color-text-muted)]">
                            Your Name
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-[var(--color-text-muted)]">
                                <svg viewBox="0 0 24 24" class="h-4 w-4"><path fill="currentColor" d="M12 12a4 4 0 1 0-4-4a4 4 0 0 0 4 4m0 2c-4 0-7 2-7 4v2h14v-2c0-2-3-4-7-4Z"/></svg>
                            </span>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="h-10 w-full rounded-full border border-[var(--color-border-subtle)] pl-9 pr-3 text-xs focus:border-[var(--color-brand-lens-blue)] focus:outline-none"
                                placeholder="Full name" />
                        </div>
                        @error('name')<p class="text-[11px] text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-medium uppercase tracking-[0.16em] text-[var(--color-text-muted)]">
                            Your Email
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-[var(--color-text-muted)]">
                                <svg viewBox="0 0 24 24" class="h-4 w-4"><path fill="currentColor" d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm0 4l-8 5L4 8V6l8 5l8-5Z"/></svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="h-10 w-full rounded-full border border-[var(--color-border-subtle)] pl-9 pr-3 text-xs focus:border-[var(--color-brand-lens-blue)] focus:outline-none"
                                placeholder="you@example.com" />
                        </div>
                        @error('email')<p class="text-[11px] text-rose-600">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-medium uppercase tracking-[0.16em] text-[var(--color-text-muted)]">
                            Phone Number
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-[var(--color-text-muted)]">
                                <svg viewBox="0 0 24 24" class="h-4 w-4"><path fill="currentColor" d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 .97-.26a11.36 11.36 0 0 0 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 7a1 1 0 0 1 1-1h2.5a1 1 0 0 1 1 1a11.36 11.36 0 0 0 .57 3.58a1 1 0 0 1-.26.97l-2.19 2.24Z"/></svg>
                            </span>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="h-10 w-full rounded-full border border-[var(--color-border-subtle)] pl-9 pr-3 text-xs focus:border-[var(--color-brand-lens-blue)] focus:outline-none"
                                placeholder="{{ config('company.phone.intl') }}" />
                        </div>
                        @error('phone')<p class="text-[11px] text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-medium uppercase tracking-[0.16em] text-[var(--color-text-muted)]">
                            Company
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-[var(--color-text-muted)]">
                                <svg viewBox="0 0 24 24" class="h-4 w-4"><path fill="currentColor" d="M3 21V3h8v6h10v12h-3v-8h-4v8h-2v-8H8v8H3Z"/></svg>
                            </span>
                            <input type="text" name="company" value="{{ old('company') }}"
                                class="h-10 w-full rounded-full border border-[var(--color-border-subtle)] pl-9 pr-3 text-xs focus:border-[var(--color-brand-lens-blue)] focus:outline-none"
                                placeholder="Brand / agency (optional)" />
                        </div>
                        @error('company')<p class="text-[11px] text-rose-600">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="text-[11px] font-medium uppercase tracking-[0.16em] text-[var(--color-text-muted)]">
                        Your Message
                    </label>
                    <textarea name="message"
                        class="min-h-[112px] w-full rounded-2xl border border-[var(--color-border-subtle)] px-3 py-2 text-xs focus:border-[var(--color-brand-lens-blue)] focus:outline-none"
                        placeholder="Tell us about your shoot, preferred dates, and any special requirements.">{{ $prefill }}</textarea>
                    @error('message')<p class="text-[11px] text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-between pt-2">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-full bg-[var(--color-brand-lens-blue)] px-5 py-2.5 text-xs font-medium text-white shadow-md shadow-[var(--color-brand-lens-blue)]/40 transition hover:-translate-y-0.5 hover:bg-[#003a88]"
                    >
                        <svg viewBox="0 0 24 24" class="h-4 w-4"><path fill="currentColor" d="M2 21v-6l12-9l4 4l-9 11H2Zm14.85-11.56l-1.41-1.41l1.78-1.79l1.41 1.42l-1.78 1.78Z"/></svg>
                        Let’s talk
                    </button>
                    <p class="hidden text-[11px] text-[var(--color-text-muted)] sm:block">
                        We’ll get back within one business day.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
