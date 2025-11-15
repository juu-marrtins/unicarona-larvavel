<?php

namespace App\Exceptions\Race;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class RaceNotFoundException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'RACE_NOT_FOUND';
    public function __construct()
    {
        $message = 'Erro ao processsar a corrida';
        Log::warning("RaceNotFoundException");
        parent::__construct($message);
    }
}
