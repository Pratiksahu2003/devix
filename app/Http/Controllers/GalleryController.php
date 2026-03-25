<?php

namespace App\Http\Controllers;

use App\Models\OurWork;
use App\Models\OurWorkImage;
use App\Models\OurWorkVideo;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkImages = OurWorkImage::query()->orderBy('sort_order')->get();
        $ourWorkVideos = $ourWork
            ? OurWorkVideo::query()
                ->where('our_work_id', $ourWork->id)
                ->orderBy('sort_order')
                ->get()
            : collect();

        return view('pages.gallery', compact('ourWork', 'ourWorkImages', 'ourWorkVideos'));
    }
}

