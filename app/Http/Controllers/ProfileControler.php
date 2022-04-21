<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Profile;
use App\Models\Profession;
use App\Services\JobApplication;
use Illuminate\Http\Request;
use Laravel\Fortify\Rules\Password;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;

class ProfileControler extends Controller
{
    public function index()
    {
        $profile = ProfileResource::make(auth()->user()->profile);

        return Inertia::render('Settings/Index', compact('profile'));
    }

    // todo Refactor later
    public function update()
    {   
        [$from, $to] = explode(' to ', request('available'));

        $profile = auth()->user()->profile;

        if (auth()->user()->cannot('update', $profile)) {
            abort(403);
        }

        if (request()->file('avatar')) {
            // update the profile photo
            auth()->user()->update([
                'profile_photo_path' => request()->file('avatar')->storePublicly('avatars', ['disk' => 'public'])
            ]);
        }

        if (request()->file('cv')) {
            $profile->update([
                'cv' => request()->file('cv')->storePublicly('application', ['disk' => 'public'])
            ]);
        }

        if (request()->file('recommendation_letter')) {
            $profile->update([
                'recommendation_letter' => request()->file('recommendation_letter')->storePublicly(
                    'application', 
                    ['disk' => 'public']
                )
            ]);
        }

        if (request()->file('nationalId')) {
            $profile->update([
                'nationalId' => request()->file('nationalId')->storePublicly(
                    'application', 
                    ['disk' => 'public']
                )
            ]);
        }

        if (request()->file('indemnity_cover')) {
            $profile->update([
                'indemnity_cover' => request()->file('indemnity_cover')->storePublicly(
                    'application', 
                    ['disk' => 'public']
                )
            ]);
        }

        $profile->update([
            'gender' =>   request('gender'),
            'about' => request('about'),
            'qualification' => request('qualification'),
            'experience' => request('level'),
            'from' => $from,
            'to' => $to,
        ]);

        return redirect('/jobs');
    }
}
