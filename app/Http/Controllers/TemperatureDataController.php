<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemperatureData;

class TemperatureDataController extends Controller
{
    public function store(Request $request)
    {
        // Validate request parameters
        $validatedData = $request->validate([
            'device_id' => 'required|string',
            'temperature' => 'required|string',
            'api_key' => 'required|string|in:1234567890', // Validate API key
        ]);

        // Insert data into database
        TemperatureData::create([
            'device_id' => $validatedData['device_id'],
            'temperature' => $validatedData['temperature'],
        ]);

        return response()->json([$validatedData['device_id'] => '1:Success'], 201);
    }



    public function viewtemp(Request $request)
    {
        // Validate request parameters
        $validatedData = $request->validate([
            'device_id' => 'required|string',
            'api_key' => 'required|string|in:1234567890', // Validate API key
        ]);

        $deviceData = TemperatureData::where('device_id',  $validatedData['device_id'])->orderBy('created_at', 'desc')->get();

        return response()->json($deviceData);
    }


}
