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
        $jobs = JobListing::latest()
            ->with('organization', 'users')
            ->where('organization_id', auth()->user()->organization_id)
            ->paginate(10); 

        $monthly = JobListing::where('organization_id', auth()->id())->monthly()->count();
        $weekly = JobListing::where('organization_id', auth()->id())->weekly()->count();
        $yearly = JobListing::where('organization_id', auth()->id())->yearly()->count();

        return Inertia::render('Dashboard/Index', [
            'jobs' => JobListingResource::collection($jobs),
            'monthly' => $monthly,
            'weekly' => $weekly,
            'yearly' => $yearly,
        ]);
    }

    public function professions()
    {
        $users = User::doctors()->with('profile')->filters([
            'city' => request('city'),
            'specialist' => request('specialist'),
            'availability' => request('availability'),
        ])
        ->paginate(10)
        ->withQueryString();

        $doctors = UserResource::collection($users);

        return Inertia::render("Dashboard/Doctors", [
            'doctors' => $doctors,
            'specials' => Speciality::getAll(),
            'filters' => request()->only('city', 'specialist', 'availability'),
        ]);
    }

    public function payment()
    {
        return Inertia::render("Dashboard/Payment");
    }
}
