<?php

namespace App\Http\Controllers;

use App\Services\JobApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\JobListing;

class ApplictionController extends Controller
{
    public function store()
    {
        $user = auth()->user();

        if ($user->profile) {
            $fieldIsMissing = collect($user->profile->getAttributes())->contains(null);
        }

        return match(true) {
            $user->isAdmin() => abort(403, 'admins are not allowed to apply'),
            $user->can('post-jobs') => abort(403, 'Organizations are not allowed to apply jobs'),
            is_null($user->profile) => redirect('/profile'),
            $fieldIsMissing  => redirect('/profile'),
            default => $this->apply($user, request('job')),
        };

    }

    public function apply($user, $job)
    {
        $job = JobListing::whereSlug($job)->firstOrFail();
        
        (new JobApplication)->applyFor($user, $job);

        return redirect('/success');
    }
}
