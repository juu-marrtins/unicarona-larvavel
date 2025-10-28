<?php

namespace App\Helpers\FormatResponse;

use Illuminate\Http\Client\Response;

class FormatResponse
{
    public static function format(Response $response): array
    {
        $isSuccess = $response->successful();
        
        return [
            'success' => $isSuccess,
            'data' => $isSuccess ? $response->json() : null,
            'message' => $isSuccess ? 'Request successful' : $response->reason(),
        ];
    }
}