<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'category_id' => ['required', 'exists:App\Category,id'],
            'price' => ['required', 'integer', 'min:0'],
            'image' => [
                'required', 
                'file', 
                'image', 
                'mimes:jpeg,jpg,png', 
                'dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000'
            ],
        ];
    }
}
