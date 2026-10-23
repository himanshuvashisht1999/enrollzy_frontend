<?php

namespace App\Http\Controllers;

use App\Support\Home\HomeData;

/** The homepage (client design "Home page v11"). The previous homepage is PageController::index / views/index.blade.php. */
class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', ['h' => HomeData::build()]);
    }
}
