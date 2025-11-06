<?php

namespace App\Services;

use App\Exceptions\Address\AddressCreateException;
use App\Repositories\RaceRepository;
use App\Helpers\AuthUtils as AuthUtils;
use App\Http\Resources\RaceResource;
use Illuminate\Support\Facades\DB;
use App\Services\AddressService;

class RaceService
{
    public function __construct(
        protected RaceRepository $raceRepository,
        protected AddressService $addressService,
        protected AuthUtils $authUtils,
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
}