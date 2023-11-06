<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PatientValidator.
 *
 * @package namespace App\Validators;
 */
class PatientValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'full_name'     => 'required|string',
            'full_name_mom' => 'required|string',
            'cpf'           => 'max:11',
            'cns'           => 'required|string|unique:patients'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
    protected $messages = [
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
