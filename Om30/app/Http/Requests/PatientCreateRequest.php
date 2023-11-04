<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name'     => 'required|string',
            'full_name_mom' => 'required|string',
            'cpf'           => 'max:11',
            'cns'           => 'required|string|unique:patients'
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'full_name.required'      => 'Campo Nome Obrigatório',
            'full_name.string'        => 'Formato Incorreto do nome',
            'full_name_mom.required'  => 'Campo Nome da mãe Obrigatório',
            'full_name_mom.string'    => 'Formato Incorreto do nome da mãe',
            'cpf.max'                 => 'Tamanho excedido do cpf',
            'cns.required'            => 'Cartão nacional de saude obrgatório',
            'cns.string'              => 'Formato Incorreto do cns',
            'cns.unique'              => 'Cartão nacional de saude já cadastrado',
        ];
    }
}
