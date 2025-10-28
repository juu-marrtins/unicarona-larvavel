<?php

namespace App\Exceptions\ExternalAPI;

use Illuminate\Support\Facades\Log;
use App\Exceptions\BaseException;

class ErrorApiExternalException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'INTERNAL_SEVERAL_ERROR';    
    public function __construct(?string $cpf = null)
    {
        $message = 'HTTP error de API externa';
        Log::warning("ErrorApiExternalException: {$cpf}");
        parent::__construct($message);
    }
}
