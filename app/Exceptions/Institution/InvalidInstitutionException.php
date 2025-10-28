<?php

namespace App\Exceptions\Institution;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class InvalidInstitutionException extends BaseException
{
    protected int $statusCode = 422;
    protected ?string $errorCode = 'INVAALID_ACADEMIC_INSTITUTION';    
    public function __construct(?string $cnpj = null)
    {
        $message = 'CNPJ nao pertence a uma instituição acadêmica';
        Log::warning("InvalidInstitutionException: {$cnpj}");
        parent::__construct($message);
    }
}
