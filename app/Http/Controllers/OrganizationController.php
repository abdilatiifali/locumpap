<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizationRequest;
use Inertia\Inertia;
use App\Models\Organization;
use App\Models\User;

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
                'organization_type', 'address', 'city', 'post_code',
            ),
        );

        // associate this user with an organization
        $user->update(['organization_id' => $organization->id]);

        \Auth::login($user);

        return redirect('/jobs');

    }
}
