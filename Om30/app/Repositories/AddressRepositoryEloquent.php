<?php

namespace App\Repositories;

use App\Presenters\AddressPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AddressRepository;
use App\Entities\Address;
use App\Validators\AddressValidator;

/**
 * Class AddressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AddressRepositoryEloquent extends AppRepository implements AddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Address::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return AddressValidator::class;
    }

    /**
     * @return string
     */
   public function presenter()
   {
       return AddressPresenter::class;
   }

}
