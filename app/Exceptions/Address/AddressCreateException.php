<?php

namespace App\Exceptions\Address;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class AddressCreateException extends BaseException
{
    protected int $statusCode = 500;
    protected ?string $errorCode = 'INSTERNAL_SEVERAL_ERROR';
    public function __construct()
    {
        $message = 'Erro ao processsar o endereço';
        Log::warning("AddressCreateException");
        parent::__construct($message);
    }
}
