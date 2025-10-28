<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class InvalidCredentialsException extends BaseException
{
    protected int $statusCode = 403;
    protected ?string $errorCode = 'INVALID_CREDENTIALS';    
    public function __construct(?string $queryParams = null)
    {
        $message = 'Credenciais Invalidas';
        Log::warning("InvalidCredentialsException: {$queryParams}");
        parent::__construct($message);
    }
}
