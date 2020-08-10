<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfileValidation extends FormRequest
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
            'last_name' => 'min:2|max:32',
            'first_name' => 'min:2|max:32',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:500' ,
            'bio' => '',
        ];
    }
}
