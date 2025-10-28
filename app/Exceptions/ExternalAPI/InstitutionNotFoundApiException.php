<?php

namespace App\Exceptions\ExternalAPI;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class InstitutionNotFoundApiException extends BaseException
{
    protected int $statusCode = 404;
    protected ?string $errorCode = 'INSTITUTION_NOT_VALIDATABLE';    
    public function __construct(?string $cpf = null)
    {
        $message = 'Instituicao nao encontrada';
        Log::warning("InstitutionNotFoundApiException: {$cpf}");
        parent::__construct($message);
    }
}
