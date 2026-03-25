<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurWorkVideo extends Model
{
    protected $fillable = [
        'our_work_id',
        'youtube_url',
        'sort_order',
    ];
}

