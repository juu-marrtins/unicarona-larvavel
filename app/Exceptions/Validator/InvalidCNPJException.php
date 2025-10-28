<?php

namespace App\Exceptions\Validator;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class InvalidCNPJException extends BaseException
{
    protected int $statusCode = 422;
    protected ?string $errorCode = 'INVALID_CNPJ';    
    public function __construct(?string $cnpj = null)
    {
        $message = 'CNPJ inválido';
        Log::warning("InvalidCNPJException: {$cnpj}");        
        parent::__construct($message);
    }
}
