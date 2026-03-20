@extends('layouts.app')

@section('title', 'Our Work | '.config('company.brand'))

@section('meta')
    <meta name="description" content="Explore the studio's latest work with a featured video and a curated gallery created at {{ config('company.brand') }} in Delhi NCR." />
@endsection

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-gradient-to-br from-[var(--color-brand-lens-blue)]/15 via-transparent to-transparent"></div>
        <div class="relative mx-auto max-w-6xl px-4 py-10 sm:px-6 sm:py-14 lg:py-16">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl">
                    <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">Our Work</h1>
                    <p class="mt-3 text-sm leading-relaxed text-[var(--color-text-muted)]">
                        A curated gallery of recent shoots, campaigns, and frames from {{ config('company.brand') }}.
                        Filter by category and open any image for a quick zoom view.
                    </p>
                    <div class="mt-5 flex flex-wrap items-center gap-3">
                        <a href="{{ route('pages.contact') }}"
                           class="inline-flex items-center rounded-full bg-[var(--color-brand-lens-blue)] px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:shadow-md hover:bg-[var(--color-brand-lens-blue)]/90">
                            Book a Session
                        </a>
                        <a href="{{ route('pages.services') }}"
                           class="inline-flex items-center rounded-full border border-[var(--color-border-subtle)] bg-white/60 px-4 py-2 text-xs font-semibold text-[var(--color-text-main)] transition hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)] hover:bg-white">
                            View Services
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white/60 p-4 backdrop-blur">
                        <div class="text-xs font-semibold text-[var(--color-text-muted)]">Gallery</div>
                        <div class="mt-2 text-2xl font-semibold">{{ $ourWorkImages?->count() ?? 0 }}</div>
                        <div class="mt-1 text-xs text-[var(--color-text-muted)]">Images</div>
                    </div>
                    <div class="rounded-2xl border border-[var(--color-border-subtle)] bg-white/60 p-4 backdrop-blur">
                        <div class="text-xs font-semibold text-[var(--color-text-muted)]">Studio</div>
                        <div class="mt-2 text-2xl font-semibold">Delhi NCR</div>
                        <div class="mt-1 text-xs text-[var(--color-text-muted)]">All sets included</div>
                    </div>
                    <div class="hidden rounded-2xl border border-[var(--color-border-subtle)] bg-white/60 p-4 backdrop-blur sm:block">
                        <div class="text-xs font-semibold text-[var(--color-text-muted)]">Featured</div>
                        <div class="mt-2 text-2xl font-semibold">{{ !empty($ourWork?->youtube_url) ? 'Yes' : 'Optional' }}</div>
                        <div class="mt-1 text-xs text-[var(--color-text-muted)]">YouTube showcase</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!empty($ourWork?->youtube_url))
        @php
            $rawUrl = (string) $ourWork->youtube_url;
            $videoId = null;
            if (preg_match('/(?:youtube\\.com\\/(?:watch\\?v=|embed\\/)|youtu\\.be\\/)([A-Za-z0-9_-]{6,})/', $rawUrl, $m)) {
                $videoId = $m[1] ?? null;
            }
            $embedUrl = $videoId ? ('https://www.youtube.com/embed/' . $videoId) : $rawUrl;
        @endphp

        <section class="bg-white py-10 sm:py-12 border-b border-[var(--color-border-subtle)]">
            <div class="mx-auto max-w-6xl px-4 sm:px-6">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold tracking-tight sm:text-xl">Featured Work Video</h2>
                        <p class="mt-1 text-xs text-[var(--color-text-muted)]">A quick reel of recent studio highlights.</p>
                    </div>
                    <a href="{{ $ourWork->youtube_url }}" target="_blank" rel="noreferrer"
                       class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">
                        Watch on YouTube
                    </a>
                </div>

                <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-black aspect-video">
                    <iframe
                        src="{{ $embedUrl }}"
                        class="w-full h-full"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                    ></iframe>
                </div>
            </div>
        </section>
    @endif

    @php
        use Illuminate\Support\Str;

        $categoryColors = [
            'Fashion' => '#fef3c7',
            'Portraits' => '#ede9fe',
            'Studio' => '#e0f2fe',
            'Other' => '#e5e7eb',
        ];

        $ourWorkNormalizePath = function (?string $imagePath): string {
            $imagePath = (string) ($imagePath ?? '');
            $imagePath = ltrim($imagePath, '/');

            // If the admin stored a full URL, keep it as-is.
            if (preg_match('/^https?:\/\//i', $imagePath) === 1) {
                return $imagePath;
            }

            return Str::startsWith($imagePath, 'storage/') ? $imagePath : ('storage/' . $imagePath);
        };

        $ourWorkCategoryFromPath = function (?string $imagePath) use ($ourWorkNormalizePath): string {
            $imagePath = (string) ($imagePath ?? '');
            if ($imagePath === '') return 'Other';

            $normalized = $ourWorkNormalizePath($imagePath);
            $after = Str::after($normalized, 'storage/');
            $firstDir = Str::before($after, '/');
            $key = Str::lower($firstDir);

            return match ($key) {
                'pooja' => 'Fashion',
                'vidhu' => 'Portraits',
                'studio' => 'Studio',
                default => ($key ? Str::title(str_replace(['-', '_'], ' ', $key)) : 'Other'),
            };
        };

        $ourWorkCategoryColor = function (string $category, array $categoryColors): string {
            return $categoryColors[$category] ?? $categoryColors['Other'];
        };

        $galleryItems = $ourWorkImages
            ?->sortBy('sort_order')
            ?->values()
            ?->map(function ($img) use ($categoryColors, $ourWorkCategoryFromPath, $ourWorkNormalizePath, $ourWorkCategoryColor) {
                $imagePath = $img->image_path ?? null;
                if (!$imagePath) return null;

                $category = $ourWorkCategoryFromPath((string) $imagePath);
                $normalized = $ourWorkNormalizePath((string) $imagePath);
                $src = preg_match('/^https?:\/\//i', $normalized) === 1 ? $normalized : asset($normalized);

                return [
                    'id' => $img->id,
                    'src' => $src,
                    'alt' => (string) ($img->alt_text ?: 'Our Work'),
                    'caption' => (string) (($img->alt_text ?: 'Our Work') . ' • ' . $category),
                    'category' => $category,
                    'bg' => $ourWorkCategoryColor($category, $categoryColors),
                ];
            })
            ?->filter()
            ?->values()
            ?->toArray() ?? [];

        $galleryCats = array_values(array_unique(array_map(function ($it) {
            return $it['category'] ?? 'Other';
        }, $galleryItems)));
        array_unshift($galleryCats, 'All');

        $imageObjects = collect($galleryItems)->map(function ($it) {
            return [
                '@type' => 'ImageObject',
                'contentUrl' => $it['src'],
                'caption' => $it['caption'],
            ];
        })->toArray();

        $galleryLd = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'Gallery | ' . config('company.brand'),
            'hasPart' => $imageObjects,
        ];
    @endphp

    <script>
        window.galleryComponent = (items, categories) => ({
            items: items || [],
            categories: categories || [],
            cat: 'All',

            lightboxOpen: false,
            lightboxSrc: '',
            lightboxAlt: '',
            lightboxCaption: '',
            scale: 1,
            panning: false,
            pointX: 0,
            pointY: 0,
            startX: 0,
            startY: 0,

            get filteredItems() {
                if (!this.cat || this.cat === 'All') return this.items;
                return this.items.filter(i => i.category === this.cat);
            },

            openLightbox(src, alt, caption) {
                this.lightboxSrc = src;
                this.lightboxAlt = alt;
                this.lightboxCaption = caption || '';
                this.lightboxOpen = true;
                this.scale = 1;
                this.pointX = 0;
                this.pointY = 0;
                document.body.style.overflow = 'hidden';
            },

            closeLightbox() {
                this.lightboxOpen = false;
                document.body.style.overflow = '';
                setTimeout(() => {
                    this.lightboxSrc = '';
                    this.lightboxAlt = '';
                    this.lightboxCaption = '';
                    this.scale = 1;
                    this.pointX = 0;
                    this.pointY = 0;
                }, 200);
            },

            zoomIn() {
                this.scale = Math.min(this.scale + 0.5, 4);
            },

            zoomOut() {
                this.scale = Math.max(this.scale - 0.5, 1);
                if (this.scale === 1) {
                    this.pointX = 0;
                    this.pointY = 0;
                }
            },

            startDrag(e) {
                if (this.scale <= 1) return;
                e.preventDefault();
                this.panning = true;
                this.startX = e.clientX - this.pointX;
                this.startY = e.clientY - this.pointY;
            },

            drag(e) {
                if (!this.panning) return;
                e.preventDefault();
                this.pointX = e.clientX - this.startX;
                this.pointY = e.clientY - this.startY;
            },

            stopDrag() {
                this.panning = false;
            }
        });
    </script>

    <section class="bg-[var(--color-surface-muted)] py-10 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div class="max-w-2xl">
                    <h2 class="text-lg font-semibold tracking-tight sm:text-xl">Gallery</h2>
                    <p class="mt-1 text-xs text-[var(--color-text-muted)]">
                        {{ count($galleryItems) }} images • Click any image to open the lightbox.
                    </p>
                </div>
            </div>

            @if(count($galleryItems) > 0)
                <div class="mt-6" x-data='window.galleryComponent(@json($galleryItems), @json($galleryCats))'>
                    {{-- Filters --}}
                    <div class="mb-5 flex flex-wrap gap-2">
                        <template x-for="c in categories" :key="c">
                            <button type="button"
                                    class="rounded-full border border-[var(--color-border-subtle)] bg-white/70 px-3 py-1.5 text-xs font-medium text-[var(--color-text-main)] transition hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)] hover:bg-white"
                                    :class="cat === c ? 'border-[var(--color-brand-lens-blue)] bg-[var(--color-brand-lens-blue)]/10 text-[var(--color-brand-lens-blue)]' : ''"
                                    @click="cat = c">
                                <span x-text="c"></span>
                            </button>
                        </template>
                    </div>

                    {{-- Grid --}}
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                        <template x-for="it in filteredItems" :key="it.id">
                            <button type="button"
                                    class="group relative overflow-hidden rounded-2xl bg-white border border-[var(--color-border-subtle)] shadow-sm transition hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[var(--color-brand-lens-blue)]/40"
                                    @click="openLightbox(it.src, it.alt, it.caption)">
                                <div class="relative aspect-[4/3]">
                                    <img
                                        :src="it.src"
                                        :alt="it.alt"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-[1.04]"
                                        :style="`background-color:${it.bg};`"
                                    />
                                    <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/10 to-transparent opacity-0 transition group-hover:opacity-100"></div>
                                    <div aria-hidden="true" class="absolute inset-x-3 bottom-3 flex items-center justify-between gap-3 opacity-0 transition group-hover:opacity-100">
                                        <span class="truncate text-xs font-semibold text-white/90" x-text="it.category"></span>
                                        <span class="shrink-0 text-xs font-semibold text-white/90">View</span>
                                    </div>
                                </div>
                            </button>
                        </template>
                    </div>

                    {{-- Lightbox Overlay --}}
                    <div x-show="lightboxOpen"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 p-4 backdrop-blur-sm"
                         @keydown.escape.window="closeLightbox()"
                         @mouseup.window="stopDrag()"
                         @mousemove.window="drag($event)"
                         style="display: none;">

                        <div class="absolute top-4 right-4 z-[101] flex items-center gap-3">
                            <div class="flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 backdrop-blur-md">
                                <button @click="zoomOut()"
                                        class="text-white hover:text-[var(--color-brand-lens-blue)] transition"
                                        type="button" title="Zoom Out">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                                <span class="text-xs font-medium text-white/80 w-10 text-center" x-text="Math.round(scale * 100) + '%'"></span>
                                <button @click="zoomIn()"
                                        class="text-white hover:text-[var(--color-brand-lens-blue)] transition"
                                        type="button" title="Zoom In">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>

                            <button @click="closeLightbox()"
                                    class="rounded-full text-white hover:text-gray-300 transition focus:outline-none"
                                    type="button" aria-label="Close">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="absolute left-4 bottom-4 right-4 z-[101]">
                            <div class="mx-auto max-w-3xl rounded-2xl bg-white/10 border border-white/10 px-4 py-3 backdrop-blur">
                                <div class="text-xs font-semibold text-white/90" x-text="lightboxCaption"></div>
                            </div>
                        </div>

                        <img
                            :src="lightboxSrc"
                            :alt="lightboxAlt"
                            class="max-h-[90vh] max-w-full rounded-xl shadow-2xl object-contain transition-transform duration-200 ease-out"
                            :style="`transform: scale(${scale}) translate(${pointX/scale}px, ${pointY/scale}px); cursor: ${scale > 1 ? 'grab' : 'default'}`"
                            @mousedown="startDrag($event)"
                            @click.outside="closeLightbox()"
                            @wheel.prevent="if($event.deltaY < 0) zoomIn(); else zoomOut();"
                        >
                    </div>
                </div>
            @else
                <div class="mt-10 rounded-3xl border border-[var(--color-border-subtle)] bg-white/60 p-8 text-center">
                    <p class="text-sm font-semibold">No images uploaded yet</p>
                    <p class="mt-2 text-xs text-[var(--color-text-muted)]">
                        Once the admin adds `Our Work` images, they will appear here automatically.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <script type="application/ld+json">{!! json_encode($galleryLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection
