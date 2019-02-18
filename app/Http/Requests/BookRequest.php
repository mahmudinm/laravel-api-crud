<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class BookRequest extends FormRequest
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
            'category_id' => 'required',
            'author_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'gambar' => 'required|mimes:jpeg,png'
        ];
    }
}
