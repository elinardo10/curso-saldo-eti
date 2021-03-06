<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoneyFormRequest extends FormRequest
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
            'value' => 'required|numeric',
        ];
    }

     public function messages(){

        return[
        'required' => 'O campo :attribute não pode ser vazio!',
        'value.numeric' => 'Apenas números é permitido. Obrigado!',
        
        ];
    }
}
