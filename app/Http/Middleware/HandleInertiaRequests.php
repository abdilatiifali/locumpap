<?php

namespace App\Http\Middleware;

use App\Models\County;
use Inertia\Middleware;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'logoUrl' => asset('/images/logo.svg'),
            'user' => auth()->user() ? [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'organizationId' => auth()->user()->organization_id,
                'avatar' => auth()->user()->profilePhotoUrl,
                'can' => [
                    'postJobs' => auth()->user()?->can('post-jobs') ?? false,
                    'viewProfile' => auth()->user()?->can('view-profile') ?? false,
                ],
                'is' => [
                    'doctor' => auth()->user()?->isDoctor(),
                ],
            ] : false,

            'flash' => [
                'status' => fn () => $request->session()->get('status')
            ],
            'counties' => County::getAll(),
        ]);
    }
}
