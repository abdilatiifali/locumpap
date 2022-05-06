<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Rules\Password;

class StoreLocumRequest extends FormRequest
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
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => 'required|string|email|unique:users|max:25|',
            'email_confirmation' => 'required|string|same:email',
            'password' => ['required', 'string', new Password, 'confirmed'],
            'countyId' => 'required|exists:counties,id',
            'specialityId' => 'required|exists:specialities,id',
            'professionId' => 'required|exists:professions,id',
            'mobile_number' => 'required',
            'registration_number' => 'required|alpha_num_|regex:/^[a-zA-Z]{1}[0-9]+/',
        ];
    }
}
