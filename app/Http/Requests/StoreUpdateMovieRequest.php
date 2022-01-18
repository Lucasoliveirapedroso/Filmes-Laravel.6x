<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateMovieRequest extends FormRequest
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
        $id = $this->segment(2);

        return [
            'name' => "required|min:1|max:255|unique:movies,name,{$id},id",
            'sinopse' => 'required|min:1|max:2550',
            'image' => 'nullable| image',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.unique' => 'Nome já existe',
            'sinopse.required' => 'Sinopse é obrigatório',
            'image.required' => 'Selecione uma imagem',
        ]; 
    }
} 
