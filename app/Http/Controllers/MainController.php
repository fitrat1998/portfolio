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
}
