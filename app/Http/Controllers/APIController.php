<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class APIController extends Controller
{
    public function handle(Request $request)
    {
        // Retrieve the 'code' parameter from the request
        $dataCode = $request->input('code');

        // Create table based on code
        $tableName = $dataCode.'_bill';
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('billnumber');
                $table->decimal('amount', 10, 2);
                $table->timestamps();
            });

            return response()->json(['message' => "Table $tableName created successfully"]);
        } else {
            return response()->json(['message' => "Table $tableName already exists"]);
        }
    }
}








