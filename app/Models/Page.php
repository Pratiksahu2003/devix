<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'admin_id', 'title', 'slug', 'content', 
        'cover_image', 'video_url', 'meta_title', 'meta_description', 'meta_keywords',
        'canonical_url', 'meta_robots', 'is_published', 'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'meta_robots' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
