<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    use HasFactory;

    /**
     * Use UUIDv7 identifiers instead of auto-incrementing integers.
     */
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'slug',
        'category',
        'frame_shape',
        'gender',
        'collection',
        'price_cents',
        'currency',
        'primary_image',
        'images',
        'short_description',
        'description',
        'stock',
        'is_featured',
        'alt_text',
        'disk',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'bool',
    ];

    public function getDisk(): ?string
    {
        return $this->disk ?: null;
    }

    protected static function booted(): void
    {
        static::creating(function (self $product): void {
            if (! $product->getKey()) {
                $product->{$product->getKeyName()} = Uuid::uuid7()->toString();
            }
        });
    }

    /**
     * Accessor for formatted price.
     */
    protected function price(): Attribute
    {
        return Attribute::get(function (): string {
            $amount = $this->price_cents / 100;

            return number_format($amount, 2);
        });
    }
}

