<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Inertia\Inertia;
use App\Models\County;
use App\Models\Department;
use App\Models\Profession;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreJobListingRequest;

class JobListingController extends Controller
{
    /**
     * Display a listing of the jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = JobListing::withOut('organization', 'users')->latest()->filter([
            'city'          => request('city'),
            'department'    => request('department'),
            'profession'    => request('profession'),
        ])->get();

        return Inertia::render('Jobs/Index', [
            'filters'           => Request::only('city', 'department', 'profession'),
            'jobs'              => $jobs->load('county', 'department', 'profession'),
            'departments'       => Department::all(),
            'professions'       => Profession::all(),
        ]);
    }

    /**
     * Display the specified job.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(JobListing $job)
    {
        return Inertia::render('Jobs/Show', [
            'job' => $job->load('organization'),
            'alreadyApplied' => auth()->user()?->alreadyApplied($job) ?? false,
            'applicants' => UserResource::collection($job->users),
        ]);
    }

    public function create()
    {        
        return Inertia::render('Jobs/Create', [
            'departments' => Department::all(),
            'professions' => Profession::all(),
            'counties' => County::all(),
        ]);
    }

    public function store(StoreJobListingRequest $request)
    {        
        $data = $request->validated();

        $job = JobListing::create(
            array_merge($data, [
                'organization_id' => auth()->user()->organization_id,
                'slug' => \Str::slug(request('title'))
            ])
        );

        return redirect('/jobs');
    }



}
