<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        try{
            $user = auth()->user();
            return $this->successResponse($user, 'User retrieved successfully', 200);
        }
        catch(\Exception $e){
            Log::error('Get User Error: '.$e->getMessage());
            return $this->errorResponse('Get User failed',500);
        }
    }
}
