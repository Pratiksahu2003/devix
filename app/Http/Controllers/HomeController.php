<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the studio homepage.
     */
    public function __invoke(): View
    {
        return view('home');
    }
}

