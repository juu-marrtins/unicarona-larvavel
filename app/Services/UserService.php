<?php

namespace App\Services;

use App\Exceptions\User\UserCreateException;
use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    public function create(array $data): User
    {
        $user = $this->userRepository->create($data);

        if(!$user)
        {
            throw new UserCreateException($data['email']);
        }

        return $user;
    }

    public function getByEmail(string $email): User
    {
        $user = $this->userRepository->findByEmail($email);

        if(!$user)
        {
            throw new UserNotFoundException($email);
        }

        return $user;
    }

    public function findById(int $id): User
    {
        $user = $this->userRepository->findById($id);

        if(!$user)
        {
            throw new UserNotFoundException($id);
        }

        return $user;
    }   
}