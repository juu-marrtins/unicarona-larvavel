<?php 


namespace App\Repositories;

use App\Models\Race;

class RaceRepository
{
    public function create(array $data): ?Race
    {
        return Race::create($data);
    }
}