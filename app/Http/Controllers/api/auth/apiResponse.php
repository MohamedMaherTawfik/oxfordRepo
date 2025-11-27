<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\JsonResponse;


trait apiResponse
{
    public static function success($data = [], $message = 'Successfully Fetched', ): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public static function unauthorized($message = 'Unauthorized'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 401);
    }

    public static function notFound($message = 'Resource not found'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 404);
    }
}