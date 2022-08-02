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
            'rate' => 'required',
            'job_type' => 'required',
            'county_id' => 'required',
            'deadline_at' => 'required|date',
            'profession_id' => 'required',
            'department_id' => 'required',
            'location' => 'required',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after:start_at',
        ];
    }
}
