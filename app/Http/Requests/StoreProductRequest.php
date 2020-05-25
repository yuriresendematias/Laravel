<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:products',
            'description' => 'required|min:3|max:10000',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório!',
            'name.min' => 'Ops! Precisa informar pelo menos 3 caracteres para o nome!',
            'photo.required' => 'Foto é obrigatória!',
            'description.min' => 'Ops! Precisa informar pelo menos 3 caracteres para a descrição!'
        ];
    }
}
