<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('self.index');
    }

    public function about()
    {
        return view('self.about');
    }

    public function services()
    {
        return view('self.services');
    }

    public function notFound()
    {
        return view('self.404');
    }

    public function testimonial()
    {
        return view('self.testimonial');
    }

    public function team()
    {
        return view('self.team');
    }

    public function feature()
    {
        return view('self.feature');
    }

    public function project()
    {
        return view('self.project');
    }

    public function contact()
    {
        return view('self.contact');
    }
}
