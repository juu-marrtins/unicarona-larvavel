<?php

namespace App\Exceptions\Institution;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class InstitutonCreateException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'INSTERNAL_SEVERAL_ERROR';
    public function __construct(?string $cnpj = null)
    {
        $message = 'Erro ao processsar o cadastro';
        Log::warning("InstitutionCreateException: {$cnpj}");
        parent::__construct($message);
    }
}
