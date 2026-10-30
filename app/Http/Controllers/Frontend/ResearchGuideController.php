<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ResearchGuideController extends Controller
{
    /**
     * Muestra la guía editorial con una estructura de artículo y barra lateral.
     * El contenido es material educativo original y no una reproducción del libro.
     */
    public function index(): View
    {
        return view('frontend.research.guide');
    }
}
