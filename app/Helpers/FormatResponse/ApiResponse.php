<?php

namespace App\Helpers\FormatResponse;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(String $message, int $status, $data): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function fail(String $message, int $status): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => [],
        ], $status);
    }
}