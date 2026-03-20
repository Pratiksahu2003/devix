<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurWorkImage extends Model
{
    protected $fillable = [
        'image_path',
        'alt_text',
        'sort_order',
    ];
}

