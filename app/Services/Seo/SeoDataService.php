<?php

namespace App\Services\Seo;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class SeoDataService
{
    protected array $memory = [];

    public function all(string $type): Collection
    {
        return collect($this->load($type));
    }

    public function load(string $type): array
    {
        if (isset($this->memory[$type])) {
            return $this->memory[$type];
        }

        $file = config("seo.files.{$type}");
        if (! $file) {
            return $this->memory[$type] = [];
        }

        $path = config('seo.data_path').'/'.$file;
        $cacheKey = config('seo.cache.prefix')."data:{$type}";

        if (config('seo.cache.enabled')) {
            $cached = $this->cache()->get($cacheKey);
            if ($cached !== null) {
                return $this->memory[$type] = $cached;
            }
        }

        if (! File::exists($path)) {
            if (app()->runningInConsole()) {
                logger()->warning("SEO dataset missing: {$path}");
            }

            return $this->memory[$type] = [];
        }

        $data = json_decode(File::get($path), true) ?? [];

        if (config('seo.cache.enabled')) {
            $this->cache()->put($cacheKey, $data, config('seo.cache.ttl'));
        }

        return $this->memory[$type] = $data;
    }

    public function find(string $type, string $slug): ?array
    {
        return $this->all($type)->first(fn (array $item) => ($item['slug'] ?? '') === $slug);
    }

    public function services(): Collection
    {
        return $this->all('services');
    }

    public function cities(): Collection
    {
        return $this->all('cities')->reject(fn (array $c) => ! empty($c['alias_of']));
    }

    public function localities(): Collection
    {
        return $this->all('localities');
    }

    public function landmarks(): Collection
    {
        return $this->all('landmarks');
    }

    public function industries(): Collection
    {
        return $this->all('industries');
    }

    public function blogs(): Collection
    {
        return $this->all('blogs');
    }

    public function serviceSlugs(): array
    {
        return $this->services()->pluck('slug')->all();
    }

    public function flushCache(): void
    {
        foreach (array_keys(config('seo.files', [])) as $type) {
            $this->cache()->forget(config('seo.cache.prefix')."data:{$type}");
        }
        $this->memory = [];
    }

    protected function cache()
    {
        $store = config('seo.cache.store');

        return $store ? Cache::store($store) : Cache::store();
    }
}
