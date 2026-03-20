<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurWorkImage extends Model
{
    protected $fillable = [
        'our_work_id',
        'image_path',
        'alt_text',
        'sort_order',
    ];
}

