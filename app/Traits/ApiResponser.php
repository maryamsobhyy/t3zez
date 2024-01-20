<?php

namespace App\Traits;

trait ApiResponser
{
    protected function generateResponse(bool $isSuccess = true, string $message = '', $data = [], $statusCode = 200, array $headers = [])
    {
        $response = [
            'success' => $isSuccess,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $statusCode, $headers);
    }
    protected function failedResponse(bool $isSuccess = false, string $message = '', $data = [], $statusCode = 404, array $headers = [])
    {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, $statusCode, $headers);
    }
   
}

