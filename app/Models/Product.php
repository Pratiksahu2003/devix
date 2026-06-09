<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuids;

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
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'price_cents' => 'integer',
        'stock' => 'integer',
    ];

    public function getDisk(): string
    {
        return 'public';
    }
}
