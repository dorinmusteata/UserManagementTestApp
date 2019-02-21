<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;

/**
 * Class JsonFormatter
 * @package App\Http\Helpers
 */
class JsonFormatter
{

    /**
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    public static function data($data, int $status = 200): JsonResponse
    {
        return response()->json([
            'data' => $data
        ], $status);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public static function error_404(string $message = ''): JsonResponse
    {
        return response()->json(['data' => ['error' => [
                'message' => $message,
                'code' => 'nof_found',
                'errors' => []
            ]]], 404);
    }

    /**
     * @param $errors
     * @return JsonResponse
     */
    public static function error_validation($errors): JsonResponse
    {
        return response()->json(['data' => ['error' => [
            'message' => 'Validation failed',
            'code' => 'validation_failed',
            'errors' => $errors
        ]]], 400);
    }

    /**
     * @param $errors
     * @param int $status
     * @return JsonResponse
     */
    public static function errors($errors, int $status = 400): JsonResponse
    {
        return response()->json(['data' => ['error' => $errors]], $status);
    }
}
