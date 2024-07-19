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

    protected function successResponsePagination($data, $message, $code = 200)
    {
        $res =  response()->json([
            'statusCode' => $code,
            'message' => $message,
            "data" => $data,
            "pagination" => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ]
        ])->setStatusCode(200);

        return $res;
    }
}
