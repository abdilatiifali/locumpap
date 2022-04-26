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
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Locum;
use App\Models\Permanent;

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

        $jobType = $this->getJobType($data);

        $cleanData = Arr::except($data, ['start_at', 'end_at']);

        JobListing::create(
            array_merge($cleanData, [
                'organization_id' => auth()->user()->organization_id,
                'slug' => Str::slug(request('title')),
                'typable_id' => $jobType->id,
                'typable_type' => get_class($jobType),
            ])
        );

        return redirect('/jobs');
    }

    public function getJobType($data)
    {
        return match ($data['job_type']) {
            'locum' => Locum::create([
                'start_at' => $data['start_at'],
                'end_at' => $data['end_at'],
            ]),
            'permanent' => Permanent::create(),
        };
    }

}
