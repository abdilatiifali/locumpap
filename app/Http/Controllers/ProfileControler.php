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
        [$from, $to] = explode(' to ', request('available'));

        $profile = auth()->user()->profile;

        if (auth()->user()->cannot('update', $profile)) {
            abort(403);
        }

        // update profile photo
        request()->file('avatar') 
            ? auth()->user()->update(['profile_photo_path' => $this->store('avatar', 'avatars')])
            : null;

        // update cv
        request()->file('cv') 
            ? $profile->update(['cv' => $this->store('cv')])
            : null;

        // update recommendation letter
        request()->file('recommendation_letter') 
            ? $profile->update(['recommendation_letter' => $this->store('recommendation_letter')])
            : null;
       
        $profile->update([
            'gender' =>   request('gender'),
            'about' => request('about'),
            'qualification' => request('qualification'),
            'nationalId' => request('nationalId'),
            'experience' => request('level'),
            'from' => $from,
            'to' => $to,
        ]);

        return redirect('/jobs');
    }

    public function store($name, $folder = 'application')
    {
        return request()->file($name)
                ->storePublicly($folder, ['disk' => 'public']);
    }
}
