<section id="pricing" class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-12">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-lg font-semibold tracking-tight sm:text-xl">
                Our pricing plans
            </h2>
            <span class="hidden text-[11px] font-medium text-[var(--color-text-muted)] sm:inline">
                Transparent hourly and full‑day packages for every production.
            </span>
        </div>

        <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $plans = [
                    [
                        'name' => '₹ 1400 · Pay per Hour',
                        'badge' => 'Studio Floor',
                        'price' => '1400',
                        'description' =>
                            'Available 24×7 · Min 3 hours · Basic equipment, 2 Godox QT 1200 IIIm, octa + strip, 2 plain backdrops, props, light assistant, makeup room.',
                        'availability' => 'Min. 3 hours · 24×7',
                        'image' => asset('storage/room/IMG_0772.jpeg'),
                        'color' => '#e6f0ff',
                    ],
                    [
                        'name' => '₹ 9000 · Pay per Day',
                        'badge' => 'Full Day',
                        'price' => '9000',
                        'description' =>
                            'Available 24×7 · Basic equipment, 2 Godox QT 1200 IIIm, 2 Godox 600, 2 textured walls, 3 plain backgrounds, props, light assistant, makeup room.',
                        'availability' => 'Day booking · 24×7',
                        'image' => asset('storage/room/IMG_0773.jpeg'),
                        'color' => '#fde68a',
                    ],
                    [
                        'name' => '₹ 15000 · All In',
                        'badge' => 'All In',
                        'price' => '15000',
                        'description' =>
                            'Available 24×7 · Full studio access, 2 Godox QT 1200 IIIm, 2 Godox 600, 3 textured walls, 3 backgrounds, props, light assistant, makeup room.',
                        'availability' => 'All in · 24×7',
                        'image' => asset('storage/room/IMG_0777.jpeg'),
                        'color' => '#e5e7eb',
                    ],
                ];
            @endphp

            @foreach ($plans as $plan)
                <x-product.card :plan="$plan" />
            @endforeach
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-3">
            @php
                $addons = [
                    [
                        'name' => '₹ 1500 · Podcast',
                        'badge' => 'Podcast Setup',
                        'price' => '1500',
                        'description' =>
                            'Available 24×7 · Min 3 hours · 3 Godox 1×1 LED panels with cutter & diffuser, set of 2 dynamic mics, light assistant, makeup room.',
                        'availability' => 'Min. 3 hours · 24×7',
                        'image' => asset('storage/studio/DSC01007.JPG'),
                        'color' => '#e6f0ff',
                    ],
                    [
                        'name' => '₹ 1500 · Videography',
                        'badge' => 'Video Lights',
                        'price' => '1500',
                        'description' =>
                            'Available 24×7 · Min 3 hours · 2 Kodak 200 constant lights with cutter & diffuser, props, light assistant, makeup room.',
                        'availability' => 'Min. 3 hours · 24×7',
                        'image' => asset('storage/studio/DSC01009.JPG'),
                        'color' => '#e5e7eb',
                    ],
                    [
                        'name' => '₹ 1500 · Edit Space',
                        'badge' => 'Edit Room',
                        'price' => '1500',
                        'description' =>
                            'Available 24×7 · Min 3 hours · Mac mini M2 Pro, 4K screen, calm edit environment, light assistant, makeup room access.',
                        'availability' => 'Min. 3 hours · 24×7',
                        'image' => asset('storage/room/IMG_0774.jpeg'),
                        'color' => '#f3e8ff',
                    ],
                ];
            @endphp

            @foreach ($addons as $plan)
                <x-product.card :plan="$plan" />
            @endforeach
        </div>
    </div>
</section>
