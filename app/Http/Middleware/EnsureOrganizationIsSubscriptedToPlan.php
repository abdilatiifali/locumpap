<?php

namespace App\Http\Middleware;

use App\Models\Organization;
use Closure;
use Illuminate\Http\Request;

class EnsureOrganizationIsSubscriptedToPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isDoctor()) {
            abort(403, 'Only organization are allowed to access this page');
        }
        $organization = Organization::findOrFail(
            $request->user()->organization_id
        );

        if (! $organization->subscribed()) {
            return $request->expectsJson()
                ? abort(403, 'You trial is offer and you havent subscripe to any plan.')
                : abort(403, 'You trial is offer and you havent subscripe to any plan.');
        }

        return $next($request);
    }
}
