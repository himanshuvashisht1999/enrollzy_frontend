<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;

class CampusController extends Controller
{
    public function show($slug)
    {
        $campus = Campus::with('organisation')->where('slug', $slug)->firstOrFail();
        
        return view('campus-detail', compact('campus'));
    }
}
