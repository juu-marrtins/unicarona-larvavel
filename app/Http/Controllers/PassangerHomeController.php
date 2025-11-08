<?php

namespace App\Http\Controllers;

use App\Helpers\FormatResponse\ApiResponse;
use App\Http\Requests\RaceListsRequest;
use App\Services\PassangerHomeService;

class PassangerHomeController extends Controller
{
    public function __construct(
        protected PassangerHomeService $passangerHomeService
    )
    {}

    public function listRaces(RaceListsRequest $request)
    {
        $races = $this->passangerHomeService->listRaces($request->validated());

        return ApiResponse::paginate(
            $races['pagination'], 
            'Dados listados com sucesso!', 
            $races['items']);
    }
}
