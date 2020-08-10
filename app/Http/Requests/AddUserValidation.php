<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserValidation extends FormRequest
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
            'username' => 'required|min:3|max:15',
            'email' => 'required|email|unique:users',
            'last_name' => 'min:2|max:32',
            'first_name' => 'min:2|max:32',
            'password' => 'required|confirmed|min:6|max:32',
            'role_id' => 'nullable',
            'company_id' => 'nullable'
        ];
    }
}
