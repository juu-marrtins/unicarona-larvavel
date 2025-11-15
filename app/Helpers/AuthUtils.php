<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthUtils
{
    public function userAuthenticated()
    {
        return Auth::user();
    }

    public function vehicleOfUser()
    {
        return $this->userAuthenticated()->vehicle;
    }

    public function InstiutionOfUser()
    {
        return $this->userAuthenticated()->institution;
    }
}