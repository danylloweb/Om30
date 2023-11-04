<?php

namespace App\Http\Controllers;

use App\Services\AddressService;
use App\Validators\AddressValidator;

/**
 * Class AddressesController.
 *
 * @package namespace App\Http\Controllers;
 */
class AddressesController extends Controller
{
    /**
     * @var AddressService
     */
    protected $service;

    /**
     * @var AddressValidator
     */
    protected $validator;

    /**
     * AddressesController constructor.
     *
     * @param AddressService $service
     * @param AddressValidator $validator
     */
    public function __construct(AddressService $service, AddressValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

}
