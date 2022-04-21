<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('post-jobs');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'title' => 'required',
            'description' => 'required',
            'rate_per_hour' => 'required',
            'job_type' => 'required',
            'county_id' => 'required',
            'profession_id' => 'required',
            'department_id' => 'required',
            'location' => 'required',
        ];
    }
}
