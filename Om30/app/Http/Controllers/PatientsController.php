<?php

namespace App\Http\Controllers;

use App\Services\PatientService;
use App\Validators\PatientValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Exceptions\RepositoryException;

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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function index(Request $request): JsonResponse
    {
        $limit     = $request->query->get('limit', 15);
        $cacheName = str_replace($request->url(), '', $request->fullUrl());
        $objects   = Cache::store('redis')->tags('patients')->remember($cacheName, 12000, function () use ($limit) {
            return $this->service->all($limit);
        });
        return response()->json($objects, 200);
    }
}
