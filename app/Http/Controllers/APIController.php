<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function handle(Request $request)
    {
        // Handle your API request here
        $dataCode = $request->input('code');
        // Process $dataCode as needed

        return response()->json(['message' => 'API request handled successfully']);
    }
}


