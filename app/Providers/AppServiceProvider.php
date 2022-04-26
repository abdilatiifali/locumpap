<?php

namespace App\Providers;

use App\Http\Resources\ProductResource;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use App\Models\JobListing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
        
        Gate::define('post-jobs', function (User $user) {
            return $user->organization == true;
        });

        Gate::define('view-profile', function (User $user) {
            return $user->organization_id == null && !$user->isAdmin() && $user->id == $user->profile?->user_id;
        });

        Gate::define('view-applicants', function (User $user, JobListing $job) {
            return $user->id == $job->organization->id;
        });

        ProductResource::withoutWrapping();
    }
}
