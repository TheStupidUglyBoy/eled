<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminCompanyUpdateRequest extends FormRequest
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
            'name' => [
        		'required' ,
        		'max:255' ,
        		Rule::unique('companies')->ignore(  $this->route('company') ),
            ],
            'website' => 'nullable|url',
            'location' => 'required|max:255',
            'about' => 'required',
            'contact_number' => 'required|digits:11',
        ];
    }
}
