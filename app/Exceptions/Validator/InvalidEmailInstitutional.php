<?php

namespace App\Exceptions\Validator;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class InvalidEmailInstitutional extends BaseException
{
    protected int $statusCode = 400;
    protected ?string $errorCode = 'INVALID_INSTITUTIONAL_EMAIL';    
    public function __construct(?string $cpf = null)
    {
        $message = 'O email informado não pertence a uma instituição acadêmica';
        Log::warning("InvalidEmailInstitutional: {$cpf}");
        parent::__construct($message);
    }
}
