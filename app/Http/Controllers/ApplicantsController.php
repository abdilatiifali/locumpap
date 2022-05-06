<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\JobListing;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\UserResource;
use App\Models\Profession;

class ApplicantsController extends Controller
{
    public function index()
    {
        $jobs = JobListing::where('organization_id', auth()->user()->organization_id)->get();

        // get all applicants for the above job
        $applicants = UserResource::collection(
            User::whereIn('id', collect($jobs->pluck('candidates'))->flatten())->get()
        );

        $professions = Profession::all();

        return Inertia::render('Applicants/Index', [
            'applicants' => $applicants,
            'professions' => $professions,
            'filters'  => request()->only('profession'),
        ]);
    }

    public function show(User $applicant)
    {
        return Inertia::render('Applicants/Show', [
            'applicant' => UserResource::make($applicant)
        ]);
    }
}
