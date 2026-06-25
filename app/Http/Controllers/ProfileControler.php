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
        return Inertia::render('Settings/Index', [
            'profile' => ProfileResource::make(auth()->user()->profile)
        ]);
    }

    // todo Refactor later
    public function update()
    {   
        $profile = auth()->user()->profile;

        if (auth()->user()->cannot('update', $profile)) {
            abort(403);
        }
        
        request()->hasFile('avatar')
            ? auth()->user()->update([
                'profile_photo_path' => request()->file('avatar')->storePublicly('avatars', 's3')
            ])
            : null;

        request()->hasFile('cv')
            ? $profile->update([
                'cv' => request()->file('cv')->storePublicly('documents', 's3')
            ])
            : null;

        request()->hasFile('recommendation_letter')
            ? $profile->update([
                'recommendation_letter' => request()->file('recommendation_letter')->storePublicly('documents', 's3')
            ])
            : null;
       
        $profile->update([
            'gender' =>   request('gender'),
            'about' => request('about'),
            'qualification' => request('qualification'),
            'nationalId' => request('nationalId'),
            'experience' => request('level'),
        ]);

        return redirect('/jobs');
    }
}
