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

    // Define table names
    $customerTableName = $dataCode.'_customer';
    $billTableName = $dataCode.'_bill';
    $billReceiptTableName = $dataCode.'_billreceipt';
    $testsTableName = $dataCode.'_tests';

    // Check if tables already exist
    if (!Schema::hasTable($customerTableName)) {
        // Create customer table
        Schema::create($customerTableName, function (Blueprint $table) {
            $table->mediumIncrements('cID');
            $table->string('Name', 30);
            $table->mediumInteger('Age');
            $table->string('Month', 20)->nullable();
            $table->string('Sex', 10);
            $table->string('Phone', 20)->nullable();
            $table->string('Whatsapp', 20)->nullable();
            $table->string('Email', 45)->nullable();
            $table->string('Location', 50)->nullable();
            $table->date('Date');
            $table->string('Password', 10);
            $table->string('Title', 10)->default('');
            $table->string('Referrer', 60)->default('');
            $table->decimal('Discount', 7, 2)->default(0.00);
            $table->timestamps();
            // $table->primary('cID');
        });
    }

    if (!Schema::hasTable($billTableName)) {
        // Create bill table
        Schema::create($billTableName, function (Blueprint $table) {
            $table->mediumIncrements('BillNo');
            $table->mediumInteger('cID');
            $table->dateTime('Date');
            $table->string('Doctor', 60)->nullable();
            $table->decimal('Discount', 7, 2);
            $table->mediumInteger('Tech');
            $table->decimal('Amount', 7, 2);
            $table->char('Status', 2)->default('0');
            $table->dateTime('RepDate')->nullable();
            $table->string('Executive', 45)->default('');
            $table->string('Specimen', 45)->default('');
            $table->string('Notes', 300)->default('');
            $table->string('Signs', 100)->default('');
            $table->string('Agent', 45)->default('');
            $table->string('RSBY', 20)->default('');
            $table->timestamps();
            // $table->primary('BillNo');
        });
    }

    if (!Schema::hasTable($billReceiptTableName)) {
        // Create billreceipt table
        Schema::create($billReceiptTableName, function (Blueprint $table) {
            $table->mediumIncrements('ID');
            $table->decimal('Amount', 7, 2);
            $table->dateTime('Date');
            $table->mediumInteger('Tech');
            $table->mediumInteger('BillNo');
            $table->decimal('Balance', 7, 2);
            $table->mediumInteger('cID')->nullable();
            $table->decimal('Received', 7, 2)->nullable();
            $table->decimal('Card', 7, 2)->nullable();
            $table->timestamps();
            // $table->primary('ID');
        });
    }

    if (!Schema::hasTable($testsTableName)) {
        // Create tests table
        Schema::create($testsTableName, function (Blueprint $table) {
            $table->increments('ID');
            $table->mediumInteger('BillNo');
            $table->string('TestID', 10)->nullable();
            $table->string('Value', 300)->nullable();
            $table->mediumInteger('Order')->nullable();
            $table->decimal('Rate', 7, 2)->nullable();
            $table->string('TestName', 70)->nullable();
            $table->string('Section', 30)->nullable();
            $table->string('SubSection', 15)->default('');
            $table->string('Specimen', 100)->nullable();
            $table->timestamps();
            // $table->primary('ID');
        });
    }

    return response()->json(['message' => "Tables created successfully"]);
}


}
























