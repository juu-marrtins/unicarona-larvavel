<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use Illuminate\Support\Facades\Log;

class FakeUserNotFoundException extends BaseException
{
    protected int $statusCode = 403;
    protected ?string $errorCode = 'FAKE_USER_NOT_FOUND';
    public function __construct(?string $query_params = null)
    {
        $message = 'Credenciais Invalidas';
        Log::warning("FakeUserNotFoundException: {$query_params}");
        parent::__construct($message);
    }
}
