<?php

namespace App\Services;

use App\Helpers\AuthUtils;
use App\Repositories\PassangerHomeRepository;
use App\Http\Resources\RaceListResource;

class PassangerHomeService
{
    public function __construct(
        protected PassangerHomeRepository $passangerHomeRepository,
        protected AuthUtils $authUtils
    ){}

    public function listRaces(array $queryParams)
    {
        $fullCity = $this->authUtils->InstiutionOfUser()->city;
        $city = explode(' - ', $fullCity)[0];

        $perPage = data_get($queryParams, 'per_page', 10);
        $page = data_get($queryParams, 'page', 1);
        $raw = data_get($queryParams, 'search');

        if (!is_string($raw)) {
            $search = $city;
        } else {
            $search = $raw;
        }

        $races = $this->passangerHomeRepository->listRaces($page, $perPage, $search);

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