<?php

namespace App\Nova\Metrics;

use App\Models\JobListing;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class TotalViews extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        [, , $jobId] = explode('/', $request->path());

        $totalViews = JobListing::findOrFail($jobId)->views;

        return $this->result($totalViews)
            ->allowZeroResult()
            ->format('0,0');
    }


    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'total-views';
    }
}
