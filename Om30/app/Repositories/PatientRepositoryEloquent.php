<?php

namespace App\Repositories;

use App\Presenters\PatientPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PatientRepository;
use App\Entities\Patient;
use App\Validators\PatientValidator;

/**
 * Class PatientRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PatientRepositoryEloquent extends AppRepository implements PatientRepository
{

    protected $fieldSearchable = [
        'cns'           => 'like',
        'full_name'     => 'like',
        'cpf'           => 'like',
        'full_name_mom' => 'like',
    ];

    /**
     * Regras para busca
     *
     * @var array
     */
    protected $fieldsRules = [
        'cns'           => ['string', 'max:18'],
        'full_name'     => ['string', 'max:100'],
        'cpf'           => ['string', 'max:20'],
        'full_name_mom' => ['string', 'max:100'],
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Patient::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return PatientValidator::class;
    }

    /**
     * @return string
     */
   public function presenter()
   {
       return PatientPresenter::class;
   }

}
