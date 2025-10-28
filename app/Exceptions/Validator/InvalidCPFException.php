<?php

namespace App\Exceptions\Validator;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class InvalidCPFException extends BaseException
{
    protected int $statusCode = 422;
    protected ?string $errorCode = 'INVALID_CPF';    
    public function __construct(?string $cpf = null)
    {
        $message = 'CPF inválido';
        Log::warning("InvalidCPFException: {$cpf}");        
        parent::__construct($message);
    }
}
