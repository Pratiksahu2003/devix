<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'admin_id', 'category_id', 'title', 'slug', 'content', 
        'cover_image', 'video_url', 'tags', 'meta_title', 'meta_description', 'meta_keywords',
        'meta_robots', 'is_published', 'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'meta_robots' => 'boolean',
        'published_at' => 'datetime',
        'tags' => 'array',
    ];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
