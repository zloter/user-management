<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        $user = '';
        $rules = [
            'first_name' => 'required|min:3|max:100',
            'last_name' => 'required|min:3|max:100',
            'email' => [
                'required',
                'email',
                'max:255',
                (!$user ? Rule::unique('users') : Rule::unique('users')->ignore($user->id))
            ],
            'password' => 'required|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        ];
        if ($this->request->get('is_employee')) {
            $rules['address_voivodeship'] = 'required|max:100';
            $rules['address_city'] = 'required|max:100';
            $rules['address_postal_code'] = 'required|max:100';
            $rules['address_street'] = 'required|max:100';
            $rules['address_number'] = 'required|max:100';
            $rules['correspondence_voivodeship'] = 'required|max:100';
            $rules['correspondence_city'] = 'required|max:100';
            $rules['correspondence_postal_code'] = 'required|max:100';
            $rules['correspondence_street'] = 'required|max:100';
            $rules['correspondence_number'] = 'required|max:100';
        }
        if ($this->request->get('is_lecturer')) {
            $rules['phone'] = 'required|max:30';
            $rules['education'] = 'between:1,6';
        }
        return $rules;
    }
}
