<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class UserNotFoundException extends BaseException
{
    protected int $statusCode = 404;
    protected ?string $errorCode = 'USER_NOT_FOUND';
    public function __construct(?string $query_params = null)
    {
        $message = 'Usuario nao encontrado';
        Log::warning("UserNotFoundException: {$query_params}");
        parent::__construct($message);
    }
}
