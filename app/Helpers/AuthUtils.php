<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class authUtils
{
    public function userAuthenticated()
    {
        return Auth::user();
    }

    public function vehicleOfUser()
    {
        return $this->userAuthenticated()->vehicle;
    }
}