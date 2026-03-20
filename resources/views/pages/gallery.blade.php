@extends('layouts.app')

@section('title', 'Our Work | '.config('company.brand'))

@section('meta')
    <meta name="description" content="Explore the studio's latest work with a featured YouTube video and a curated image gallery created at {{ config('company.brand') }} in Delhi NCR." />
@endsection

@section('content')
    <section class="border-b border-[var(--color-border-subtle)] bg-[var(--color-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-1.5 sm:px-6 lg:py-2">
            <h1 class="text-lg font-semibold tracking-tight sm:text-xl">
                Our Work
            </h1>
            <p class="mt-1.5 max-w-2xl text-xs leading-relaxed text-[var(--color-text-muted)]">
                A curated mix of latest shoots, campaigns, and frames. Admin can optionally add a YouTube showcase video
                and upload images that appear here dynamically.
            </p>
        </div>
    </section>

    @if(!empty($ourWork?->youtube_url))
        <section class="bg-white py-12 border-b border-[var(--color-border-subtle)]">
            <div class="mx-auto max-w-6xl px-4 sm:px-6">
                <div class="flex items-end justify-between gap-4">
                    <h2 class="text-lg font-semibold tracking-tight sm:text-xl">Featured Work Video</h2>
                    <a
                        href="{{ $ourWork->youtube_url }}"
                        target="_blank"
                        rel="noreferrer"
                        class="text-xs font-semibold text-indigo-600 hover:text-indigo-700"
                    >
                        Watch on YouTube
                    </a>
                </div>

                @php
                    $rawUrl = $ourWork->youtube_url;
                    $videoId = null;

                    // Robust extraction for:
                    // - https://www.youtube.com/watch?v=VIDEO_ID
                    // - https://youtu.be/VIDEO_ID
                    // - https://www.youtube.com/embed/VIDEO_ID
                    if (preg_match('/(?:youtube\\.com\\/(?:watch\\?v=|embed\\/)|youtu\\.be\\/)([A-Za-z0-9_-]{6,})/', $rawUrl, $m)) {
                        $videoId = $m[1] ?? null;
                    }

                    $embedUrl = $videoId ? ('https://www.youtube.com/embed/' . $videoId) : $rawUrl;
                @endphp

                <div class="mt-6 rounded-2xl overflow-hidden border border-slate-200 bg-black aspect-video">
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
        $galleryCats = ['All','Fashion','Portraits','Studio'];
        $items = [
            // Pooja Session (Fashion)
            ['alt' => 'Fashion session - DSC00956', 'cat' => 'Fashion', 'color' => '#fef3c7', 'src' => 'storage/pooja/DSC00956.JPG'],
            ['alt' => 'Fashion session - DSC00957', 'cat' => 'Fashion', 'color' => '#fde68a', 'src' => 'storage/pooja/DSC00957.JPG'],
            ['alt' => 'Fashion session - DSC00958', 'cat' => 'Fashion', 'color' => '#dbeafe', 'src' => 'storage/pooja/DSC00958.JPG'],
            ['alt' => 'Fashion session - DSC00959', 'cat' => 'Fashion', 'color' => '#dbeafe', 'src' => 'storage/pooja/DSC00959.JPG'],
            ['alt' => 'Fashion session - DSC00960', 'cat' => 'Fashion', 'color' => '#fde68a', 'src' => 'storage/pooja/DSC00960.JPG'],
            ['alt' => 'Fashion session - DSC00961', 'cat' => 'Fashion', 'color' => '#e5e7eb', 'src' => 'storage/pooja/DSC00961.JPG'],
            ['alt' => 'Fashion session - DSC00962', 'cat' => 'Fashion', 'color' => '#dbeafe', 'src' => 'storage/pooja/DSC00962.JPG'],
            ['alt' => 'Fashion session - DSC00963', 'cat' => 'Fashion', 'color' => '#f5f5f7', 'src' => 'storage/pooja/DSC00963.JPG'],
            ['alt' => 'Fashion session - DSC00964', 'cat' => 'Fashion', 'color' => '#e5e7eb', 'src' => 'storage/pooja/DSC00964.JPG'],
            ['alt' => 'Fashion session - DSC00965', 'cat' => 'Fashion', 'color' => '#f5f5f7', 'src' => 'storage/pooja/DSC00965.JPG'],
            ['alt' => 'Fashion session - DSC00966', 'cat' => 'Fashion', 'color' => '#e5e7eb', 'src' => 'storage/pooja/DSC00966.JPG'],
            ['alt' => 'Fashion session - DSC00968', 'cat' => 'Fashion', 'color' => '#fef3c7', 'src' => 'storage/pooja/DSC00968.JPG'],
            ['alt' => 'Fashion session - DSC00969', 'cat' => 'Fashion', 'color' => '#e5e7eb', 'src' => 'storage/pooja/DSC00969.JPG'],
            ['alt' => 'Fashion session - DSC00970', 'cat' => 'Fashion', 'color' => '#dbeafe', 'src' => 'storage/pooja/DSC00970.JPG'],
            ['alt' => 'Fashion session - DSC00971', 'cat' => 'Fashion', 'color' => '#fde68a', 'src' => 'storage/pooja/DSC00971.JPG'],
            ['alt' => 'Fashion session - DSC00972', 'cat' => 'Fashion', 'color' => '#e5e7eb', 'src' => 'storage/pooja/DSC00972.JPG'],
            ['alt' => 'Fashion session - DSC00973', 'cat' => 'Fashion', 'color' => '#f5f5f7', 'src' => 'storage/pooja/DSC00973.JPG'],
            ['alt' => 'Fashion session - DSC00974', 'cat' => 'Fashion', 'color' => '#fef3c7', 'src' => 'storage/pooja/DSC00974.JPG'],
            ['alt' => 'Fashion session - DSC00975', 'cat' => 'Fashion', 'color' => '#fde68a', 'src' => 'storage/pooja/DSC00975.JPG'],
            ['alt' => 'Fashion session - DSC00976', 'cat' => 'Fashion', 'color' => '#f5f5f7', 'src' => 'storage/pooja/DSC00976.JPG'],
            ['alt' => 'Fashion session - DSC00977', 'cat' => 'Fashion', 'color' => '#dbeafe', 'src' => 'storage/pooja/DSC00977.JPG'],
            ['alt' => 'Fashion session - DSC00978', 'cat' => 'Fashion', 'color' => '#dbeafe', 'src' => 'storage/pooja/DSC00978.JPG'],
            ['alt' => 'Fashion session - DSC00979', 'cat' => 'Fashion', 'color' => '#ede9fe', 'src' => 'storage/pooja/DSC00979.JPG'],
            ['alt' => 'Fashion session - DSC00980', 'cat' => 'Fashion', 'color' => '#f5f5f7', 'src' => 'storage/pooja/DSC00980.JPG'],
            ['alt' => 'Fashion session - DSC00981', 'cat' => 'Fashion', 'color' => '#dbeafe', 'src' => 'storage/pooja/DSC00981.JPG'],

            // Vidhu Session (Portraits)
            ['alt' => 'Portraits session - DSC00982', 'cat' => 'Portraits', 'color' => '#ede9fe', 'src' => 'storage/vidhu/DSC00982.JPG'],
            ['alt' => 'Portraits session - DSC00983', 'cat' => 'Portraits', 'color' => '#fde68a', 'src' => 'storage/vidhu/DSC00983.JPG'],
            ['alt' => 'Portraits session - DSC00984', 'cat' => 'Portraits', 'color' => '#e5e7eb', 'src' => 'storage/vidhu/DSC00984.JPG'],
            ['alt' => 'Portraits session - DSC00985', 'cat' => 'Portraits', 'color' => '#f5f5f7', 'src' => 'storage/vidhu/DSC00985.JPG'],
            ['alt' => 'Portraits session - DSC00986', 'cat' => 'Portraits', 'color' => '#e5e7eb', 'src' => 'storage/vidhu/DSC00986.JPG'],
            ['alt' => 'Portraits session - DSC00987', 'cat' => 'Portraits', 'color' => '#f5f5f7', 'src' => 'storage/vidhu/DSC00987.JPG'],
            ['alt' => 'Portraits session - DSC00988', 'cat' => 'Portraits', 'color' => '#dbeafe', 'src' => 'storage/vidhu/DSC00988.JPG'],
            ['alt' => 'Portraits session - DSC00989', 'cat' => 'Portraits', 'color' => '#e5e7eb', 'src' => 'storage/vidhu/DSC00989.JPG'],
            ['alt' => 'Portraits session - DSC00990', 'cat' => 'Portraits', 'color' => '#fde68a', 'src' => 'storage/vidhu/DSC00990.JPG'],
            ['alt' => 'Portraits session - DSC00991', 'cat' => 'Portraits', 'color' => '#ede9fe', 'src' => 'storage/vidhu/DSC00991.JPG'],
            ['alt' => 'Portraits session - DSC00992', 'cat' => 'Portraits', 'color' => '#fef3c7', 'src' => 'storage/vidhu/DSC00992.JPG'],
            ['alt' => 'Portraits session - DSC00993', 'cat' => 'Portraits', 'color' => '#dbeafe', 'src' => 'storage/vidhu/DSC00993.JPG'],
            ['alt' => 'Portraits session - DSC00994', 'cat' => 'Portraits', 'color' => '#fde68a', 'src' => 'storage/vidhu/DSC00994.JPG'],
            ['alt' => 'Portraits session - DSC00995', 'cat' => 'Portraits', 'color' => '#ede9fe', 'src' => 'storage/vidhu/DSC00995.JPG'],
            ['alt' => 'Portraits session - DSC00996', 'cat' => 'Portraits', 'color' => '#f5f5f7', 'src' => 'storage/vidhu/DSC00996.JPG'],
            ['alt' => 'Portraits session - DSC00997', 'cat' => 'Portraits', 'color' => '#e5e7eb', 'src' => 'storage/vidhu/DSC00997.JPG'],

             // Studio Session
             ['alt' => 'Studio session - DSC01002', 'cat' => 'Studio', 'color' => '#ede9fe', 'src' => 'storage/studio/DSC01002.JPG'],
             ['alt' => 'Studio session - DSC01003', 'cat' => 'Studio', 'color' => '#fde68a', 'src' => 'storage/studio/DSC01003.JPG'],
             ['alt' => 'Studio session - DSC01007', 'cat' => 'Studio', 'color' => '#fef3c7', 'src' => 'storage/studio/DSC01007.JPG'],
             ['alt' => 'Studio session - DSC01008', 'cat' => 'Studio', 'color' => '#ede9fe', 'src' => 'storage/studio/DSC01008.JPG'],
             ['alt' => 'Studio session - DSC01009', 'cat' => 'Studio', 'color' => '#f5f5f7', 'src' => 'storage/studio/DSC01009.JPG'],
             ['alt' => 'Studio session - DSC01010', 'cat' => 'Studio', 'color' => '#dbeafe', 'src' => 'storage/studio/DSC01010.JPG'],
             ['alt' => 'Studio session - DSC01012', 'cat' => 'Studio', 'color' => '#e5e7eb', 'src' => 'storage/studio/DSC01012.JPG'],
        ];

        // If admin uploaded "Our Work" images, replace the hardcoded fallback list.
        if (isset($ourWorkImages) && $ourWorkImages && $ourWorkImages->count() > 0) {
            $galleryCats = ['All'];

            $items = $ourWorkImages
                ->sortBy('sort_order')
                ->values()
                ->map(function ($img) {
                    $imgPath = (string) ($img->image_path ?? '');
                    $src = \Illuminate\Support\Str::startsWith($imgPath, 'storage/')
                        ? $imgPath
                        : ('storage/' . ltrim($imgPath, '/'));

                    return [
                        'alt' => $img->alt_text ?: 'Our Work',
                        'cat' => 'All',
                        'color' => '#e5e7eb',
                        'src' => $src,
                    ];
                })
                ->toArray();
        }
         function lqip($color) {
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="12"><rect width="100%" height="100%" fill="'.$color.'"/></svg>';
            return 'data:image/svg+xml;charset=UTF-8,'.rawurlencode($svg);
        }
        function srcset($base) {
            // For optimized images, we might not have different sizes generated yet, 
            // but the resize script ensures they are max 1200px.
            // We can just return the base image for now as we overwrote the originals with optimized versions.
            return $base.' 1200w';
        }
    @endphp
    <script>
        window.galleryLightbox = (cats) => ({
            cat: 'All',
            show: 12,
            cats: cats,
            lightboxOpen: false,
            lightboxSrc: '',
            lightboxAlt: '',
            scale: 1,
            panning: false,
            pointX: 0,
            pointY: 0,
            startX: 0,
            startY: 0,
            openLightbox(src, alt) {
                this.lightboxSrc = src;
                this.lightboxAlt = alt;
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
                    this.scale = 1;
                    this.pointX = 0;
                    this.pointY = 0;
                }, 300);
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

    <section class="bg-[var(--color-surface-muted)]" x-data="window.galleryLightbox(@json($galleryCats))">
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
            
            <div class="absolute top-6 right-6 flex items-center gap-4 z-50">
                <div class="flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 backdrop-blur-md">
                    <button @click="zoomOut()" class="text-white hover:text-[var(--color-brand-lens-blue)] transition" title="Zoom Out">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                    </button>
                    <span class="text-xs font-medium text-white/80 w-8 text-center" x-text="Math.round(scale * 100) + '%'"></span>
                    <button @click="zoomIn()" class="text-white hover:text-[var(--color-brand-lens-blue)] transition" title="Zoom In">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    </button>
                </div>
                
                <button @click="closeLightbox()" class="text-white hover:text-gray-300 transition">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <img :src="lightboxSrc" :alt="lightboxAlt" 
                 class="max-h-[90vh] max-w-full rounded-lg shadow-2xl object-contain transition-transform duration-200 ease-out"
                 :style="`transform: scale(${scale}) translate(${pointX/scale}px, ${pointY/scale}px); cursor: ${scale > 1 ? 'grab' : 'default'}`"
                 @mousedown="startDrag($event)"
                 @click.outside="closeLightbox()"
                 @wheel.prevent="if($event.deltaY < 0) zoomIn(); else zoomOut();">
        </div>

        <div class="mx-auto max-w-7xl px-4 py-1.5 sm:px-6 lg:py-2">
            <div class="mb-2 flex flex-wrap justify-center gap-1">
                <template x-for="c in cats" :key="c">
                    <button type="button"
                        class="rounded-full border border-[var(--color-border-subtle)] bg-white px-3 py-1.5 text-xs font-medium text-[var(--color-text-main)] transition hover:border-[var(--color-brand-lens-blue)] hover:text-[var(--color-brand-lens-blue)] hover:shadow-sm"
                        :class="cat === c ? 'border-[var(--color-brand-lens-blue)] bg-blue-50 text-[var(--color-brand-lens-blue)]' : ''"
                        @click="cat = c; show = 12">
                        <span x-text="c"></span>
                    </button>
                </template>
            </div>

            {{-- Masonry Layout --}}
            <div class="columns-3 sm:columns-4 md:columns-5 lg:columns-6 xl:columns-8 2xl:columns-9 gap-1 space-y-1">
                @foreach($items as $it)
                    <figure class="group break-inside-avoid overflow-hidden rounded-md bg-white shadow-sm transition hover:shadow-md cursor-zoom-in"
                        x-show="cat === 'All' || $el.dataset.cat === cat"
                        x-transition
                        data-cat="{{ $it['cat'] }}"
                        @click="openLightbox('{{ asset($it['src']) }}', '{{ $it['alt'] }}')">
                        <div class="relative overflow-hidden">
                            <img
                                alt="{{ $it['alt'] }}"
                                loading="lazy"
                                decoding="async"
                                class="block w-full h-auto object-cover transition duration-700 ease-out group-hover:scale-[1.03]"
                                src="{{ asset($it['src']) }}"
                                style="background: url('{{ lqip($it['color']) }}') center/cover no-repeat;"
                                onload="this.style.background='none';"
                            />
                            <div class="absolute inset-0 bg-black/0 transition group-hover:bg-black/10"></div>
                        </div>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    @php
        $imageObjects = collect($items)->map(function($it) {
            return [
                '@type' => 'ImageObject',
                'contentUrl' => asset($it['src']),
                'caption' => $it['alt'].' ('.$it['cat'].')',
            ];
        })->toArray();
        $galleryLd = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'Gallery | '.config('company.brand'),
            'hasPart' => $imageObjects,
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($galleryLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endsection
