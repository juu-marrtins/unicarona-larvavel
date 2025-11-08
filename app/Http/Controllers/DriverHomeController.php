<?php

namespace App\Http\Controllers;

use App\Helpers\FormatResponse\ApiResponse;
use App\Http\Requests\RecentRacesRequest;
use App\Services\DriverHomeService;

class DriverHomeController extends Controller
{
    public function __construct(
        protected DriverHomeService $driverHomeService
    )
    {}
    public function recentRaces(RecentRacesRequest $request)
    {
        $races = $this->driverHomeService->recentRaces($request->validated());
        return ApiResponse::paginate(
            $races['pagination'], 
            'Dados listados com sucesso!', 
            $races['items']
        );
    }
}
