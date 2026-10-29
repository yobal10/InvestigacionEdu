<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class MethodologyController extends Controller
{
    public function index()
    {
        return view('frontend.methodology.index');
    }
}
