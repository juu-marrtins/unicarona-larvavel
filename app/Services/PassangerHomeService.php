<?php

namespace App\Services;

use App\Repositories\PassangerHomeRepository;
use App\Http\Resources\RaceListResource;

class PassangerHomeService
{
    public function __construct(
        protected PassangerHomeRepository $passangerHomeRepository
    ){}

    public function listRaces(array $queryParams)
    {
        $perPage = data_get($queryParams, 'per_page', 10);
        $page = data_get($queryParams, 'page', 1);

        $races = $this->passangerHomeRepository->listRaces($page, $perPage, $queryParams);

        return [
            'items' => RaceListResource::collection($races),
            'pagination' => [
                'currentPage' => $page,
                'lastPage' => $races->lastPage(),
                'perPage' => $perPage,
                'total' => $races->total(),
            ]
        ];
    }
}