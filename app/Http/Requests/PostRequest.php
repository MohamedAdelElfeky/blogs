<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|string|regex:/^[\pL\s\-]+$/u',
            'image' => 'required|image|mimes:webp,png,jpg|max:2048',
            'content' => 'required|min:20',
        ];
    }
}
