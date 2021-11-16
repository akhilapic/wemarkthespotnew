<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotspotUpdatesController extends Controller
{
    public function index()
    {
            return view('wemarkthespot.hotspot-updates');
    }
}
