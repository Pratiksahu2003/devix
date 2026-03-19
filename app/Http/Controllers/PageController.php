<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        // Serve the dynamically structured page, ensuring it is officially published.
        $page = Page::where('slug', $slug)
                    ->where('is_published', true)
                    ->firstOrFail();

        return view('pages.show', compact('page'));
    }
}
