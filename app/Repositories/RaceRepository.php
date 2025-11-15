<?php 


namespace App\Repositories;

use App\Models\Race;
use App\Models\RacePassenger;

class RaceRepository
{
    public function create(array $data): ?Race
    {
        return Race::create($data);
    }

    public function findById(int $id): ?Race
    {
        return Race::find($id);
    }

    public function createRequest(int $passengerId, int $raceId): ?RacePassenger
    {
        return RacePassenger::create([
            'passenger_id' => $passengerId,
            'race_id' => $raceId,
            'status' => 'requested',
        ]);
    }
}