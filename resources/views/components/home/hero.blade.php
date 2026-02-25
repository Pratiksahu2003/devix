<section id="about" class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
    <div class="mx-auto flex max-w-6xl flex-col gap-10 px-4 py-10 sm:px-6 lg:flex-row lg:items-center lg:py-14">
        <div class="flex-1 space-y-5">
            <p class="text-[11px] font-medium uppercase tracking-[0.28em] text-[var(--color-text-muted)]">
                rental podcast &amp; content studio
            </p>
            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl lg:text-5xl">
                A studio that fits
                <span
                    class="bg-gradient-to-r from-[var(--color-brand-lens-blue)] to-[var(--color-brand-gold-accent)] bg-clip-text text-transparent">
                    every frame.
                </span>
            </h1>
            <p class="max-w-xl text-sm leading-relaxed text-[var(--color-text-muted)]">
                Studio on rent for photo, video, and podcast shoots in Delhi NCR – a full‑service space where you can
                capture, record, and edit under one roof.
            </p>
            <div class="flex flex-wrap gap-3 pt-1">
                <a
                    href="#pricing"
                    class="inline-flex items-center rounded-full bg-[var(--color-brand-lens-blue)] px-5 py-2.5 text-xs font-medium text-white shadow-md shadow-[var(--color-brand-lens-blue)]/40 transition hover:-translate-y-0.5 hover:bg-[#003a88]"
                >
                    View studio pricing
                </a>
                <a
                    href="#contact"
                    class="inline-flex items-center rounded-full border border-[var(--color-border-subtle)] bg-white px-4 py-2.5 text-xs font-medium text-[var(--color-text-main)] shadow-sm transition hover:-translate-y-0.5 hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)] hover:shadow-md"
                >
                    Book your slot
                </a>
            </div>
            <dl class="mt-6 grid max-w-md grid-cols-3 gap-4 text-[11px] text-[var(--color-text-muted)]">
                <div>
                    <dt class="font-semibold text-[var(--color-text-main)]">Born in Delhi</dt>
                    <dd>Central studio for NCR creators.</dd>
                </div>
                <div>
                    <dt class="font-semibold text-[var(--color-text-main)]">24×7 open</dt>
                    <dd>Flexible slots for any schedule.</dd>
                </div>
                <div>
                    <dt class="font-semibold text-[var(--color-text-main)]">Under one roof</dt>
                    <dd>Shoot, record &amp; edit in one space.</dd>
                </div>
            </dl>
        </div>

        <div class="flex-1">
            <div
                class="relative aspect-[4/5] overflow-hidden rounded-[2.25rem] border border-[var(--color-border-subtle)] bg-[var(--color-brand-lens-blue-soft)] shadow-[0_24px_60px_rgba(15,23,42,0.18)]">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/18 via-transparent to-white/30 mix-blend-multiply"></div>
                <div
                    class="pointer-events-none absolute inset-6 rounded-[1.75rem] border border-white/40 bg-gradient-to-br from-white/40 via-white/10 to-transparent backdrop-blur-sm">
                </div>
                <div class="relative flex h-full flex-col justify-between p-6">
                    <div class="flex items-center justify-between text-[11px] text-white/85">
                        <span class="inline-flex items-center gap-1 rounded-full bg-black/25 px-3 py-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            In-studio fit ready
                        </span>
                        <span class="rounded-full bg-black/25 px-3 py-1">
                            Virtual try-on
                        </span>
                    </div>
                    <div class="space-y-2 text-white">
                        <p class="text-[11px] uppercase tracking-[0.28em] text-white/70">featured collection</p>
                        <img src="{{ asset(config('company.logo')) }}" alt="{{ config('company.brand') }}" class="h-12 w-auto object-contain mb-2" />
                        <p class="max-w-xs text-[12px] text-white/80">
                            A flexible content studio for portraits, campaigns, podcasts, and everything in between.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
