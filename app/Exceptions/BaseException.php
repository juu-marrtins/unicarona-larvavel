<?php

namespace App\Exceptions;

use App\Helpers\FormatResponse\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class BaseException extends Exception
{
    protected int $statusCode = 500;
    protected ?string $errorCode = null;
    protected array $context = [];    public function render($request): JsonResponse
    {
        return ApiResponse::fail(
            $this->getMessage(),
            $this->statusCode,
            $this->errorCode
        );
    }
}