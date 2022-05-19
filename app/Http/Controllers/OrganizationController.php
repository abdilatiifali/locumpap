<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use Inertia\Inertia;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class OrganizationController extends Controller
{
    public function index()
    {
        return Inertia::render("Organization/Index");
    }

    public function create()
    {
        return Inertia::render("Organization/Create");
    }

    public function store(StoreOrganizationRequest $request)
    {        
        $user = User::createNewUser(
            $request->only('first_name', 'last_name', 'email', 'password', 'organization')
        );

        $organization = Organization::createNewOrganization($request->only(
                'organization_name', 'email', 'county', 'phone_number',
                'organization_type', 'address', 'city', 'post_code', 'registration_number',
            ),
        );

        // associate this user with an organization
        $user->update(['organization_id' => $organization->id]);

        event(new Registered(auth()->user()));

        \Auth::login($user);

        return Inertia::location('/jobs');

    }
}
