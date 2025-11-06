<?php

namespace App\Services;

use App\Exceptions\Address\AddressCreateException;
use App\Repositories\AddressRepository;

class AddressService
{
    public function __construct(
        protected AddressRepository $addressRepository,
    )
    {}

    public function create(array $data)
    {
        $address = $this->addressRepository->create($data);

        if(!$address)
        {
            throw new AddressCreateException();
        }

        return $address;
    }
}