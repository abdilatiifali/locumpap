<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        $partners = [
            'dental' => asset('/images/partners/dental.jpeg'),
            'pearl' => asset('/images/partners/pearl.jpeg'),
            'albania' => asset('/images/partners/albani-hospita.jpeg'),
            'transistor' => asset('/images/partners/ottoman-hospital.jpeg'),
            'workcation' => 'https://tailwindui.com/img/logos/workcation-logo-gray-400.svg',
        ];

        return Inertia::render('Welcome', [
            'heroImageUrl' => asset('/heroimage.jpeg'),
            'testimonialImageUrl' => asset('/women.jpeg'),
            'partners' => $partners,
        ]);
    }
}
