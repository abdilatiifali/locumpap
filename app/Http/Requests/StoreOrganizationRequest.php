<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use App\Models\User;

class StoreOrganizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'organization_name' => 'required|string|max:40',
            'email' => [
                'required',
                'string',
                'email',
                'max:40',
                Rule::unique(User::class),
            ],
            'email_confirmation' => 'required|string|same:email',
            'password' => ['required', 'string', new Password, 'confirmed'],
            'county' => 'required',
            'phone_number' => 'required',
            'organization_type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'post_code' => 'required',
        ];
    }
}
