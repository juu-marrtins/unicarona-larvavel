<?php

namespace App\Repositories;

use App\Filters\DriverHomeFilter;
use App\Helpers\AuthUtils;
use App\Models\Race;

class DriverHomeRepository
{
    public function __construct(
        protected AuthUtils $authUtils
    )
    {}
    public function recentRaces(int $page, int $perPage, array $filterData)
    {
        $query = (new DriverHomeFilter(
            Race::with(['passengers.passenger']) 
                ->where('driver_id', $this->authUtils->userAuthenticated()->id)
                ->orderByDesc('created_at'),
            $filterData
        ))->applyFilter();

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}