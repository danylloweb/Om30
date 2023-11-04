<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Repositories\AddressRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * AddressService
 */
class AddressService extends AppService
{
    protected $repository;

    /**
     * @param AddressRepository $repository
     */
    public function __construct(AddressRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @param int $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function all(int $limit = 20)
    {
        return $this->repository
            ->resetCriteria()
            ->pushCriteria(app(AppRequestCriteria::class))
            ->paginate($limit);
    }

}
