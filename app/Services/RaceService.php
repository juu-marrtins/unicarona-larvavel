<?php

namespace App\Services;

use App\Exceptions\Address\AddressCreateException;
use App\Exceptions\Race\InsuficientSeatsException;
use App\Exceptions\Race\RaceNotFoundException;
use App\Exceptions\Race\RequestRaceException;
use App\Exceptions\Race\RaceAlreadyStartedException;
use App\Repositories\RaceRepository;
use App\Helpers\AuthUtils;
use App\Http\Resources\RaceResource;
use Illuminate\Support\Facades\DB;
use App\Services\AddressService;

class RaceService
{
    public function __construct(
        protected RaceRepository $raceRepository,
        protected AddressService $addressService,
        protected AuthUtils $authUtils,
        protected UserService $userService,
    ){}

    public function create(array $data)
    {
        $race = $this->raceRepository->create($data);

        if(!$race)
        {
            throw new AddressCreateException();
        }

        return $race;
    }

    public function findById(int $id)
    {
        $race = $this->raceRepository->findById($id);

        if(!$race)
        {
            throw new RaceNotFoundException();
        }

        return $race;
    }

    public function createRequest(int $passenger_id, int $race_id)
    {
        $requested = $this->raceRepository->createRequest($passenger_id, $race_id);

        if(!$requested)
        {
            throw new RequestRaceException();
        }

        return $requested;
    }

    public function createRaceAndAddress(array $data)
    {
        $originAddressData = [
            'street' => $data['origin_street'],
            'number' => $data['origin_number'],
            'district' => $data['origin_district'],
            'city' => $data['origin_city'],
            'state' => $data['origin_state'],
        ];

        $arrivalAddressData = [
            'street' => $data['destination_street'],
            'number' => $data['destination_number'],
            'district' => $data['destination_district'],
            'city' => $data['destination_city'],
            'state' => $data['destination_state'],
        ];

        $raceData = [
            'driver_id' => $this->authUtils->userAuthenticated()->id,
            'vehicle_id' => $this->authUtils->vehicleOfUser()->id,
            'departure_time' => $data['departure_time'],
            'arrival_time' => $data['arrival_time'],
            'total_seats' => $this->authUtils->vehicleOfUser()->seats,
            'available_seats' => $data['available_seats'],
            'status' => 'available',
        ];

        return DB::transaction(function () use ($originAddressData, $arrivalAddressData, $raceData) {

            $origin = $this->addressService->create($originAddressData);
            $arrival = $this->addressService->create($arrivalAddressData);

            $raceData['origin_id'] = $origin->id;
            $raceData['destination_id'] = $arrival->id;
            $race = $this->create($raceData);

            return new RaceResource($race);  
        });
    }

    public function requestRace(array $data)
    {
        $race_id = $data['race_id'];
        $passenger_id = $this->authUtils->userAuthenticated()->id;

        return DB::transaction(function () use ($race_id, $passenger_id) {
            $race = $this->findById($race_id);

            $race->status != 'available' ? throw new RaceAlreadyStartedException() : null;

            $race->available_seats = $race->available_seats>0 ? $race->available_seats-1 : throw new InsuficientSeatsException();  
            $race->save();

            $passenger = $this->userService->findById($passenger_id);

            $racePassenger = $this->createRequest($passenger->id, $race->id);

            return [
                'race_id' => $race->id,
                'passenger_id' => $passenger->id,
                'status' => $racePassenger->status,
            ];
        });
    }
}