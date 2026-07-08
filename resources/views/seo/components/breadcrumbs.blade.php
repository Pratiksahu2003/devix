<nav class="flex text-sm text-text-muted space-x-2 py-2" aria-label="Breadcrumb">
    <a href="/" class="hover:text-brand-lens-blue transition">Home</a>
    <span>/</span>
    @if(isset($service))
        <a href="/services" class="hover:text-brand-lens-blue transition">Services</a>
        <span>/</span>
        <span class="text-text-main font-semibold">{{ $service['name'] }}</span>
        <span>/</span>
    @endif
    <span class="text-text-main font-semibold truncate">{{ $page['h1'] ?? '' }}</span>
</nav>
