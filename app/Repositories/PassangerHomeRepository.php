<?php

namespace App\Repositories;

use App\Filters\PassangerHomeFilter;
use App\Models\Race;

class PassangerHomeRepository
{
    public function listRaces(int $page, int $perPage, $search)
    {
        $query = (new PassangerHomeFilter(
            Race::where('status', 'available'), 
            $search
        ))->applyFilter();

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}