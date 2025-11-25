<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationStoreRequest;
use App\Models\Location;

class LocationController extends Controller
{
    public function locationStore(LocationStoreRequest $request)
    {
        try{
            $data =$request->validated();

            $user = auth()->user();
            $data['user_id'] = $user->id;
            $data['created_at'] = now();
            
            Location::create($data);
            return $this->successResponse([], 'Location stored successfully', 201);
        }
        catch(\Exception $e){
            Log::error('Location Store Error: '.$e->getMessage());
            return $this->errorResponse('Failed to store location', 500);
        }
    }

    public function userLocation(Request $request)
    {
        try{
            $user = auth()->user();
            $locations = Location::where('user_id', $user->id)->get();

            return $this->successResponse($locations, 'User locations retrieved successfully', 200);
        }
        catch(\Exception $e){
            Log::error('User Location Retrieval Error: '.$e->getMessage());
            return $this->errorResponse('Failed to retrieve user locations', 500);
        }
    }
}
