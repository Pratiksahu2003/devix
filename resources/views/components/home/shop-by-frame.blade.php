<section id="services" class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface-muted)]">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-[11px] font-medium uppercase tracking-[0.28em] text-[var(--color-text-muted)]">
                    our services
                </p>
                <h2 class="mt-1 text-lg font-semibold tracking-tight sm:text-xl">
                    Crafting visual stories starts here.
                </h2>
            </div>
                <span class="hidden text-[11px] font-medium text-[var(--color-text-muted)] sm:inline">
                    Portraits, campaigns, podcasts, corporate films &amp; more.
                </span>
        </div>

        <div class="mt-6 grid grid-cols-3 gap-4 sm:grid-cols-4 md:grid-cols-6">
            @php
                $services = [
                    ['label' => 'Portrait', 'subtitle' => 'Headshots & personal branding', 'route' => 'pages.photography', 'icon' => 'user'],
                    ['label' => 'Fashion', 'subtitle' => 'Lookbooks & campaigns', 'route' => 'pages.photography', 'icon' => 'hanger'],
                    ['label' => 'Product', 'subtitle' => 'E‑commerce & catalog', 'route' => 'pages.photography', 'icon' => 'box'],
                    ['label' => 'Corporate', 'subtitle' => 'Profiles & interviews', 'route' => 'pages.videography', 'icon' => 'briefcase'],
                    ['label' => '24×7 Open', 'subtitle' => 'Slots that fit your crew', 'route' => 'pages.about', 'icon' => 'clock'],
                    ['label' => 'Makeup Room', 'subtitle' => 'Ready‑to‑go green room', 'route' => 'pages.edit-room', 'icon' => 'brush'],
                    ['label' => 'Edit Room', 'subtitle' => 'Mac + 4K edit setup', 'route' => 'pages.edit-room', 'icon' => 'monitor'],
                    ['label' => 'Dedicated Spaces', 'subtitle' => 'Modular sets & props', 'route' => 'pages.studio-specs', 'icon' => 'grid'],
                ];
            @endphp

            @foreach ($services as $service)
                <a href="{{ route($service['route']) }}" class="group flex flex-col items-center gap-2 text-center">
                    <div class="relative inline-flex h-20 w-20 items-center justify-center rounded-full border border-[var(--color-border-subtle)] bg-white shadow-sm shadow-black/5 transition group-hover:-translate-y-1 group-hover:shadow-md sm:h-24 sm:w-24">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-b from-white to-slate-100 opacity-70"></div>
                        <svg aria-hidden="true" viewBox="0 0 24 24" class="icon-breath relative h-8 w-8 text-[var(--color-text-main)] transition group-hover:text-[var(--color-brand-lens-blue)] sm:h-10 sm:w-10">
                            @php $i = $service['icon']; @endphp
                            @if ($i === 'user')
                                <path fill="currentColor" d="M12 12a4 4 0 1 0-4-4a4 4 0 0 0 4 4m0 2c-4 0-7 2-7 4v2h14v-2c0-2-3-4-7-4Z"/>
                            @elseif ($i === 'hanger')
                                <path fill="currentColor" d="M12 6a2 2 0 0 1 2 2v.5l8 5v2l-8-5v3L4 16v-2l8-3V8a1 1 0 0 0-1-1H9V6z"/>
                            @elseif ($i === 'box')
                                <path fill="currentColor" d="M21 8l-9-5l-9 5l9 5l9-5Zm-9 7l-9-5v9l9 5l9-5V10l-9 5Z"/>
                            @elseif ($i === 'briefcase')
                                <path fill="currentColor" d="M10 6V4h4v2h4a2 2 0 0 1 2 2v2h-6v2h-4V10H4V8a2 2 0 0 1 2-2h4Zm-6 6h6v2h4v-2h6v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6Z"/>
                            @elseif ($i === 'clock')
                                <path fill="currentColor" d="M12 2a10 10 0 1 0 0 20a10 10 0 0 0 0-20Zm1 11h4v-2h-3V6h-2v7Z"/>
                            @elseif ($i === 'brush')
                                <path fill="currentColor" d="M3 17c0 2.21 1.79 4 4 4c1.79 0 3-1 3-2.5c0-.83-.67-1.5-1.5-1.5c-.5 0-.96.23-1.24.6c-.45-.38-.74-.95-.74-1.6c0-1.1.9-2 2-2h1l7-7l-2-2l-7 7v1c-2.21 0-4 1.79-4 4Z"/>
                            @elseif ($i === 'monitor')
                                <path fill="currentColor" d="M5 3h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-5v2h2v2H8v-2h2v-2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm0 2v10h14V5H5Z"/>
                            @elseif ($i === 'grid')
                                <path fill="currentColor" d="M3 3h8v8H3V3Zm10 0h8v8h-8V3ZM3 13h8v8H3v-8Zm10 0h8v8h-8v-8Z"/>
                            @endif
                        </svg>
                        <div class="pointer-events-none absolute inset-x-2 bottom-2 hidden rounded-lg bg-black/0 px-2 py-1 text-[10px] text-white opacity-0 transition group-hover:block group-hover:bg-black/40 group-hover:opacity-100">
                            Open {{ $service['label'] }}
                        </div>
                    </div>
                    <span class="text-[11px] font-medium tracking-tight text-[var(--color-text-main)]">
                        {{ $service['label'] }}
                    </span>
                    <span class="text-[10px] text-[var(--color-text-muted)]">
                        {{ $service['subtitle'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
