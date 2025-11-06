<?php

namespace App\Exceptions\Race;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class RaceCreateException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'INSTERNAL_SEVERAL_ERROR';
    public function __construct()
    {
        $message = 'Erro ao processsar a corrida';
        Log::warning("RaceCreateException");
        parent::__construct($message);
    }
}
