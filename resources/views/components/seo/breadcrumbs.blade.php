@props(['crumbs' => [], 'theme' => 'dark'])

@if(count($crumbs))
<nav aria-label="Breadcrumb" class="mb-6">
    <ol class="flex flex-wrap items-center gap-1.5 text-xs {{ $theme === 'light' ? 'text-gray-500' : 'text-white/60' }}">
        @foreach($crumbs as $i => $crumb)
            <li class="flex items-center gap-1.5">
                @if($i > 0)
                    <svg class="h-3 w-3 shrink-0 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                @endif
                @if($i === count($crumbs) - 1)
                    <span class="font-medium {{ $theme === 'light' ? 'text-gray-900' : 'text-white' }}">{{ $crumb['label'] }}</span>
                @else
                    <a href="{{ $crumb['url'] }}" class="hover:underline {{ $theme === 'light' ? 'hover:text-[var(--color-brand-lens-blue)]' : 'hover:text-white' }} transition-colors">{{ $crumb['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
