<?php

namespace App\Services;

use App\Ai\Agents\ProductAltTextAgent;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Laravel\Ai\Files;

class ProductAltTextService
{
    /**
     * Generate and persist alt text for the given product if possible.
     */
    public function generateForProduct(Product $product, ?string $imagePath = null): ?string
    {
        if (! $imagePath) {
            $imagePath = $product->primary_image;
        }

        if (! $imagePath || ! Storage::disk($product->getDisk() ?? config('filesystems.default'))->exists($imagePath)) {
            return null;
        }

        $disk = $product->getDisk() ?? config('filesystems.default');
        $localPath = Storage::disk($disk)->path($imagePath);

        $attachments = [
            Files\Image::fromPath($localPath),
        ];

        /** @var \Laravel\Ai\Responses\AgentResponse|string $response */
        $response = ProductAltTextAgent::make()
            ->forProduct($product)
            ->prompt('Describe this image in one alt attribute sentence.', attachments: $attachments);

        $alt = trim((string) $response);

        if ($alt === '') {
            return null;
        }

        $product->alt_text = $alt;
        $product->save();

        return $alt;
    }

    /**
     * Generate alt text for all products missing it.
     */
    public function generateForMissingProducts(): void
    {
        Product::query()
            ->whereNull('alt_text')
            ->whereNotNull('primary_image')
            ->chunkById(25, function ($products): void {
                foreach ($products as $product) {
                    $this->generateForProduct($product);
                }
            });
    }
}

