<?php

namespace App\Http\Controllers\api\student;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public static function success($data = [], $message = 'Successfully Fetched'): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    public static function badRequest($message, ): JsonResponse
    {
        return response()->json([
            'status' => 'Bad Request',
            'message' => $message,
        ], 400);
    }

    public static function notFound($message = 'Resource not found'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 404);
    }

    public static function serverError($message = 'Server Error'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 500);
    }
    public static function unauthorized($message = 'Unauthorized'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 401);
    }

    public static function forbidden($message = 'Forbidden'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 403);
    }
    public static function created($data = [], $message = 'Resource created successfully'): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], 201);
    }
    public static function noContent(): JsonResponse
    {
        return response()->json([], 204);
    }

}
