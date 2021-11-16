<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityReviewsController extends Controller
{
    public function index()
    {
         return view('wemarkthespot.community-reviews');
    }
}
