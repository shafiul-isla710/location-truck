<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    
    // User Registration
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

    //User login
    public function login(LoginRequest $request)
    {
        try{
            $request->validated();

            $credentials = $request->only('email', 'password');
            
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }

            return response()->json([
                'token' => $token,
                'token_type' => 'bearer',
                // 'expires_in' => auth()->factory('api')->getTTL() * 60
            ]);
        }
        
        catch(\Exception $e){
            Log::error('Login Error: '.$e->getMessage());
            return $this->errorResponse('Login failed',500);
        }
    }
}
