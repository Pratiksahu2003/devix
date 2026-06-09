<?php

namespace App\Ai\Agents;

use App\Models\Product;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Promptable;
use Laravel\Ai\Responses\AgentResponse;
use Stringable;

class ProductAltTextAgent implements Agent
{
    use Promptable {
        prompt as protected traitPrompt;
    }

    protected ?string $productContext = null;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<'TEXT'
You are an SEO and accessibility expert for a rental photography, videography, and podcast studio in Delhi NCR.

Write concise, human‑sounding HTML image alt text for product or studio images. Follow these rules:
- Keep alt text between 80 and 140 characters.
- Describe what is visually in the image and how it relates to the studio or package.
- Use simple, natural language – no keyword stuffing.
- If a product name or plan name is provided, incorporate it naturally.
- Mention lighting, sets or equipment only when it is visually obvious or clearly described.
- Do not include words like "image of", "photo of", or file names.
TEXT;
    }

    /**
     * Attach product context for the next prompt call.
     */
    public function forProduct(Product $product, ?string $imageDescription = null): static
    {
        $this->productContext = collect([
            "Product / plan name: {$product->name}",
            $product->short_description ? "Short description: {$product->short_description}" : null,
            $product->category ? "Category: {$product->category}" : null,
            $product->collection ? "Collection: {$product->collection}" : null,
            $imageDescription ? "Image notes: {$imageDescription}" : null,
        ])
            ->filter()
            ->implode("\n");

        return $this;
    }

    public function prompt(
        string $prompt,
        array $attachments = [],
        Lab|array|string|null $provider = null,
        ?string $model = null,
        ?int $timeout = null,
    ): AgentResponse {
        if ($this->productContext !== null) {
            $prompt = "Generate alt text for this image:\n\n{$this->productContext}\n\n{$prompt}";
        }

        return $this->traitPrompt($prompt, $attachments, $provider, $model, $timeout);
    }
}
