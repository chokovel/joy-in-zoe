<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Show the About page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the Missions Education page.
     */
    public function missions()
    {
        return view('pages.missions');
    }

    /**
     * Show the Contact page.
     */
    public function contact()
    {
        return view('contact');
    }
}
