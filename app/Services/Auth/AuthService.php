<?php 

namespace App\Services\Auth;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\User\FakeUserNotFoundException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Resources\UserResource;
use App\Services\InstitutionService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function __construct(
        protected InstitutionService $institutionService,
        protected UserService $userService,
    )
    {}

    public function register(array $data)
    {
        $extractData = $this->institutionService->validateInstitution($data['cnpj']);

        $institutionData = [
            'name' => $extractData['nome'],
            'cnpj' => $data['cnpj'],
            'city' => $extractData['municipio'],
            'state' => $extractData['uf'] . ' - ' . $extractData['logradouro'] . ' - ' . $extractData['bairro'] .' - ' . $extractData['numero'],
            'validator' => "receitasw"
        ];

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'RA' => $data['ra'],
            'phone' => $data['phone'],
            'user_type' => $data['user_type'],
            'user_title' => $data['user_title'],
            'cpf' => $data['cpf'],
            'course' => $data['course'],
            'role_id' => 2
        ];

        return DB::transaction(function () use ($institutionData, $userData, $extractData) {

            if(!isset($extractData['alreadyExist']))
            {
                $institution = $this->institutionService->create($institutionData);
                $userData['institution_id'] = $institution->id;
                $user = $this->userService->create($userData);
                
                return [
                    'institution' => $institution->name,
                    'user' => new UserResource($user),
                ];
            }
            $userData['institution_id'] = $extractData['id'];
            $user = $this->userService->create($userData);

            return [
                'institution' => $extractData['nome'],
                'user' => new UserResource($user),
            ];
        }); 
    }

    public function login(array $data)
    {   
        try{
            $user = $this->userService->getByEmail($data['email']);
        } catch (UserNotFoundException $e) {
            throw new FakeUserNotFoundException($data['email']);
        }

        if(!Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            throw new InvalidCredentialsException($data['email']);
        }

        return [
            'token' => $user->createToken('plainTextToken')->plainTextToken,
            'role' => $user->role->id,
            'user' => new  UserResource($user)
        ];
    }
}