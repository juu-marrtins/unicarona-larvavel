<?php

namespace App\Exceptions\Race;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class RequestRaceException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'ERROR_REQUEST_RACE';
    public function __construct()
    {
        $message = 'Erro ao processsar o pedido de corrida';
        Log::warning("RequestRaceException");
        parent::__construct($message);
    }
}
