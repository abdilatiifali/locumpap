<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\JobListing;
use App\Http\Resources\JobListingResource;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\Speciality;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = JobListing::with('organization', 'users')
            ->where('organization_id', auth()->user()->organization_id)->get();

        return Inertia::render('Dashboard/Index', [
            'jobs' => JobListingResource::collection($jobs)
        ]);
    }

    public function doctors()
    {
        $users = User::doctors()->with('profile')->filters([
            'city' => request('city'),
            'specialist' => request('specialist'),
            'availability' => request('availability'),
        ])->get();
        
        $doctors = UserResource::collection($users);

        return Inertia::render("Dashboard/Doctors", [
            'doctors' => $doctors,
            'specials' => Speciality::all(),
            'filters' => request()->only('city', 'specialist', 'availability'),
        ]);
    }
}
