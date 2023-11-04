<?php

namespace App\Http\Controllers;

use App\Services\PatientService;
use App\Validators\PatientValidator;

/**
 * Class PatientsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PatientsController extends Controller
{
    /**
     * @var PatientService
     */
    protected $service;

    /**
     * @var PatientValidator
     */
    protected $validator;

    /**
     * PatientsController constructor.
     *
     * @param PatientService $service
     * @param PatientValidator $validator
     */
    public function __construct(PatientService $service, PatientValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

}
