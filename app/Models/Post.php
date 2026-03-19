<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id', 'admin_id', 'title', 'slug', 'excerpt', 'content', 
        'cover_image', 'meta_title', 'meta_description', 
        'is_published', 'published_at'
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
