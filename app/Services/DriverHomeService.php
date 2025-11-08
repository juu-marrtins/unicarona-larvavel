<?php

namespace App\Services;

use App\Http\Resources\DriverHomeResource;
use App\Repositories\DriverHomeRepository;

class DriverHomeService
{
    public function __construct(
        protected DriverHomeRepository $driverHomeRepository
    )
    {}

    public function recentRaces(array $queryParams)
    {
        $page = data_get($queryParams, 'page', 1);
        $perPage = data_get($queryParams, 'per_page', 10);

        $races = $this->driverHomeRepository->recentRaces($page, $perPage, $queryParams);

        return [
            'items' => DriverHomeResource::collection($races),
            'pagination' => [
                'currentPage' => $page,
                'lastPage' => $races->lastPage(),
                'perPage' => $perPage,
                'total' => $races->total(),
            ]
        ];
    }
}