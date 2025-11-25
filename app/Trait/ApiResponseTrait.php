<?php

namespace App\Trait;

trait ApiResponseTrait
{
    // success response method
    public function successResponse($data = [], $message = null, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ],$code);
    }

    // error response method
    public function errorResponse($message = null,$code)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ],$code);
    }
}
