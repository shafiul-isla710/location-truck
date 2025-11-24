<?php

namespace App\Trait;

trait ApiResponseTrait
{
    // success response method
    public function successResponse($status = true, array $data = [], $message = null, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ],$code);
    }

    // error response method
    public function errorResponse($status = false, $message = null,$code)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ],$code);
    }
}
