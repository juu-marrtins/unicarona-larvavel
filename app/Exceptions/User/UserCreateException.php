<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class UserCreateException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'INSTERNAL_SEVERAL_ERROR';
    public function __construct(?string $cpf = null)
    {
        $message = 'Erro ao processsar o cadastro';
        Log::warning("userCreateException: {$cpf}");
        parent::__construct($message);
    }
}
