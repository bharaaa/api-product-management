<?php

namespace App\Traits;

trait ApiResponse
{
    public function successResponse($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function errorResponse($message, $code)
    {
        return response()->json([
            'message' => $message,
            'data' => null
        ], $code);
    }
}
