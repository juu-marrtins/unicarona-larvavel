<?php

namespace App\Exceptions\Race;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class RaceAlreadyStartedException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'CANT_REQUEST_RACE';
    public function __construct()
    {
        $message = 'Não é possível iniciar uma corrida já iniciada, finalizada ou em andamento';
        Log::warning("RaceAlreadyStartedException");
        parent::__construct($message);
    }
}
