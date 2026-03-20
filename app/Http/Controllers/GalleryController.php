<?php

namespace App\Http\Controllers;

use App\Models\OurWork;
use App\Models\OurWorkImage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $ourWork = OurWork::query()->latest('id')->first();
        $ourWorkImages = OurWorkImage::query()->orderBy('sort_order')->get();

        return view('pages.gallery', compact('ourWork', 'ourWorkImages'));
    }
}

