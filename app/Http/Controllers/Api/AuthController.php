<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    
    public function register(RegisterRequest $request)
    {
        try{
            $data = $request->validated();

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
            return $this->successResponse([], 'Registration successful', 201);

        }
        catch(\Exception $e){
            Log::error('Registration Error: '.$e->getMessage());
            return $this->errorResponse('Registration failed',500);
        }
    }
}
