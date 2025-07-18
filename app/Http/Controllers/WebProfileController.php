<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebProfileController extends Controller
{
    /**
     * Display the main landing page
     */
    public function index()
    {
        return view('web.home');
    }

    /**
     * Display features page
     */
    public function features()
    {
        return view('web.features');
    }

    /**
     * Display pricing page
     */
    public function pricing()
    {
        return view('web.pricing');
    }

    /**
     * Display about page
     */
    public function about()
    {
        return view('web.about');
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('web.contact');
    }

    /**
     * Display demo page
     */
    public function demo()
    {
        return view('web.demo');
    }
} 