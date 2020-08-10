<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateValidation extends FormRequest
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
            'title' => 'required|max:500',
            'description' => 'required',
            'category_id' => 'required',
            'tag' => 'required',
            'thumb_nail_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'nullable',
            'brand_name' => 'nullable',
            'model' => 'nullable',
            'input_power' => 'nullable',
            'input_voltage' => 'nullable',
            'working_frequency' => 'nullable',
            'lumen' => 'nullable',
            'cct' => 'nullable',
            'life_span' => 'nullable',
            'size' => 'nullable',
            'confirm_add_product_to_post' => 'nullable|boolean',
            'captcha' => 'required|captcha'
        ];
    }
}
