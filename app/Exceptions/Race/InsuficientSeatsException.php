<?php

namespace App\Exceptions\Race;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class InsuficientSeatsException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'INSUFFICIENT_SEATS';
    public function __construct()
    {
        $message = 'Não há mais vagas disponíveis para a corrida';
        Log::warning("InsuficientSeatsException");
        parent::__construct($message);
    }
}
