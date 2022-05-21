<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'heroImageUrl' => asset('/heroimage.jpeg'),
            'testimonialImageUrl' => asset('/women.jpeg'),
        ]);
    }
}
