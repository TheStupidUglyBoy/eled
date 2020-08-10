<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => 'required|max:255|unique:companies',
            'website' => 'nullable|url',
            'location' => 'required|max:255',
            'about' => 'required',
            'contact_number' => 'required|digits:11',
            'business_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ];
    }

    protected function getRedirectUrl()
    {
        return parent::getRedirectUrl() . '#company';
    }
}
