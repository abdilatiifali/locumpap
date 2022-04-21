<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Profession;
use Laravel\Fortify\Rules\Password;
use App\Models\User;
use App\Models\Profile;
use App\Models\Speciality;
use App\Http\Requests\StoreLocumRequest;

class LocumController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return redirect('/jobs');
        }

        return Inertia::render('Locum/Index');
    }

    public function create()
    {
        return Inertia::render('Locum/Create', [
            'professions' => Profession::all(),
            'specials' => Speciality::all(),
        ]);
    }

    public function store(StoreLocumRequest $request)
    {    

        $user = User::createNewUser(
            $request->only('first_name', 'last_name', 'email', 'password', 'organization')
        );

        $profile = Profile::create([
            'user_id' => $user->id,
            'mobile_number' => $request->mobile_number,
            'professional_registration_number' => $request->registration_number,
            'profession_id' => request('professionId'),
            'county_id' => request('countyId'),
            'speciality_id' => request('specialityId'),
        ]);

        \Auth::login($user);

        return redirect('/jobs');
    }
}

