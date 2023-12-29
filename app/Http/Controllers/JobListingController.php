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
use App\Http\Resources\JobListingResource;

class JobListingController extends Controller
{
    /**
     * Display a listing of the jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = JobListing::withOut('organization')->latest()->filter([
            'city'          => request('city'),
            'department'    => request('department'),
            'profession'    => request('profession'),
            'type'          => Str::lower(request('type')),
        ])
        ->with('users', 'county', 'profession', 'department')
        ->paginate()
        ->withQueryString();

        $jobs = JobListingResource::collection($jobs);

        return Inertia::render('Jobs/Index', [
            'filters'           => Request::only('type', 'city', 'department', 'profession'),
            'jobs'              => $jobs,
            'departments'       => Department::getAll(),
            'professions'       => Profession::getAll(),
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
        \DB::table('job_listings')->where('id', $job->id)
                    ->increment('views');
        
        return Inertia::render('Jobs/Show', [
            'job' => $job->load('organization'),
            'alreadyApplied' => auth()->user()?->alreadyApplied($job) ?? false,
            'applicants' => UserResource::collection($job->users),
        ]);
    }

    public function create()
    {        
        return Inertia::render('Jobs/Create', [
            'departments' => Department::getAll(),
            'professions' => Profession::getAll(),
        ]);
    }

    public function store(StoreJobListingRequest $request)
    {      
        $data = $request->validated();

        $jobType = $this->getJobType($data);

        $cleanData = Arr::except($data, ['start_at', 'end_at', 'job_type']);

        $location = strtolower(preg_replace("/[^\w]+/", "-", $cleanData['location']));

        JobListing::create(
            array_merge($cleanData, [
                'organization_id' => auth()->user()->organization_id,
                'slug' => Str::slug(request('title')) . '-from-' . $location,
                'candidates' => [],
                'typable_id' => $jobType->id,
                'typable_type' => get_class($jobType),
            ])
        );

        return redirect('/jobs');
    }

    public function getJobType($data)
    {
        $type = Str::lower($data['job_type']);

        return match ($type) {
            'locum' => Locum::create([
                'start_at' => $data['start_at'],
                'end_at' => $data['end_at'],
            ]),
            'permanent' => Permanent::create(),
            default => throw new \Exception('Hello'),
        };
    }

}
