<?php

namespace App\Http\Controllers;

use App\Helpers\FormatResponse\ApiResponse;
use App\Services\RaceService;
use App\Http\Requests\Race\CreateRaceRequest;
use App\Http\Requests\RequestRideRequest;

class RaceController extends Controller
{
    public function __construct(
        protected RaceService $raceService
    )
    {}

    public function create(CreateRaceRequest $request)
    {
        $race = $this->raceService->createRaceAndAddress($request->validated());
        return ApiResponse::success(
            'Corrida criada com sucesso!',
            201,
            $race
        );
    }

    public function requestRace(RequestRideRequest $request)
    {
        $requested  = $this->raceService->requestRace($request->validated());
        return ApiResponse::success(
            'Passagem solicitada com sucesso!',
            201,
            $requested
        );
    }
}