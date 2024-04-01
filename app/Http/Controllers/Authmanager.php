<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use App\Models\Owners;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Authmanager extends Controller
{


    function welcome()
    {
         return view('welcome');
    }














    function customer()
    {
        $customerdata = User::all()->reverse();
         return view('customer.customer',compact('customerdata'));
    }


    function  createcustomer()
    {
         return view('customer.createcustomer');
    }














    function createcustomerpost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'password' => 'required|string|min:6|same:confirmpassword',
            'mobilenumber' => 'required|string|min:10|max:10|unique:users',
        ], [

            'password.min' => 'The password must be at least :min characters.',
            'password.same' => 'The password is not matching.',

            'mobilenumber.min' => 'The Mobile number must be at least :min characters.',
            'mobilenumber.max' => 'The Mobile number not be greater than :max characters.',
            'mobilenumber.unique' => 'The Mobile number has already been taken, change number.',
        ], [
            'min' => ':attribute must be at least :min characters.',
            'max' => ':attribute not be greater than :max characters.',
        ]);





        $data['name'] = $request->name;
        $data['location'] = $request->location;
        $data['password'] = Hash::make($request->password);
        $data['mobilenumber'] = $request->mobilenumber;
        $user = User::create($data);



        if (!$user) {
            return redirect(route('createcustomer'))->with("error", "register failed, Try again");
        }

        return redirect(route('customer'))->with("success", "login from here");
    }




    public function viewcustomer($id)
     {
    $customer = User::find($id);
    return view('customer.viewcustomer', ['customer' => $customer]);
    }



    public function   editcustomer($id)
    {
   $customer = User::find($id);
   return view('customer.editcustomer', ['customer' => $customer]);
   }



  public function updatecustomer(Request $request, $id)
  {


    $request->validate([
        'name' => 'required',
        'location' => 'required',
        // 'password' => 'required|string|min:6',
        'mobilenumber' => 'required|string|min:10|max:10|unique:users,mobilenumber,'.$id, // Add $id to ignore current user
    ], [

        // 'password.min' => 'The password must be at least :min characters.',
        // 'password.same' => 'The password is not matching.',

        'mobilenumber.min' => 'The Mobile number must be at least :min characters.',
        'mobilenumber.max' => 'The Mobile number not be greater than :max characters.',
        'mobilenumber.unique' => 'The Mobile number has already been taken, change number.',
    ], [
        'min' => ':attribute must be at least :min characters.',
        'max' => ':attribute not be greater than :max characters.',
    ]);



    $customer = User::find($id);
    $customer->name = $request->input('name');
    $customer->location = $request->input('location');
    $customer->mobilenumber = $request->input('mobilenumber');

    // Check if a new password is provided
    if (!empty($request->input('password'))) {


        $request->validate([
            'password' => 'required|string|min:6',
        ], [

            'password.min' => 'The password must be at least :min characters.',
            'password.same' => 'The password is not matching.',
        ], [
            'min' => ':attribute must be at least :min characters.',
            'max' => ':attribute not be greater than :max characters.',
        ]);



        $customer->password = Hash::make($request->input('password'));
    }


    $customer->update();
    return redirect(route('viewcustomer', ['id' => $id]));
  }







  public function deletecustomer($id)
  {
    $customer = User::find($id);

      if ( $customer) {
        $customer->delete();
      return redirect(route('customer'))->with('status', "Data deleted successfully.");
     } else {
     return redirect(route('customer'))->with('error', "Data not found or already deleted.");
       }
}
























    function branch()
    {

         $branchdata = Branch::all()->reverse();
         return view('branch.branch',compact('branchdata'));
    }


    function  createbranch()
    {

         return view('branch.createbranch');
    }




    function createbranchpost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'apikey' => 'required|string|min:10',
            'pass' => 'required|string|min:6',
            'mobilenumber' => 'required|string|min:10|max:10',
        ], [
            'pass.min' => 'The password must be at least :min characters.',
            'apikey' => 'The Api key must be at least :min characters.',
            'mobilenumber.min' => 'The Mobile number must be at least :min characters.',
            'mobilenumber.max' => 'The Mobile number not be greater than :max characters.',
        ], [
            'min' => ':attribute must be at least :min characters.',
            'max' => ':attribute not be greater than :max characters.',
        ]);






        $data['name'] = $request->name;
        $data['location'] = $request->location;
        $data['apikey'] = $request->apikey;
        $data['password'] = $request->pass;
        $data['mobilenumber'] = $request->mobilenumber;
        $user = Branch::create($data);



        if (!$user) {
            return redirect(route('createbranch'))->with("error", "register failed, Try again");
        }

        $branchId = $user->id;
        $customerTableName =  $branchId . '_customer';
        $billTableName =  $branchId . '_bill';
        $billReceiptTableName =  $branchId . '_billreceipt';
        $testsTableName =  $branchId . '_tests';

        if (!Schema::hasTable($customerTableName)) {
            Schema::create($customerTableName, function (Blueprint $table) {
                // Define schema for customer table
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
            });
        }

        if (!Schema::hasTable($billTableName)) {
            Schema::create($billTableName, function (Blueprint $table) {
                // Define schema for bill table
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
            });
        }

        if (!Schema::hasTable($billReceiptTableName)) {
            Schema::create($billReceiptTableName, function (Blueprint $table) {
                // Define schema for billreceipt table
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
            });
        }

        if (!Schema::hasTable($testsTableName)) {
            Schema::create($testsTableName, function (Blueprint $table) {
                // Define schema for tests table
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
            });
        }

        return redirect(route('branch'))->with("success");
    }




    public function viewbranch($id)
     {
    $branch = Branch::find($id);
    return view('branch.viewbranch', ['branch' => $branch]);
    }


    public function   editbranch($id)
    {
   $branch = Branch::find($id);
   return view('branch.editbranch', ['branch' => $branch]);
   }






   public function updatebranch(Request $request, $id)
  {


    $request->validate([
        'name' => 'required',
        'location' => 'required',
        'apikey' => 'required|string|min:10',
        'pass' => 'required|string|min:6',
        'mobilenumber' => 'required|string|min:10|max:10',
    ], [

        'pass.min' => 'The password must be at least :min characters.',
        'apikey' => 'The Api key must be at least :min characters.',
        'mobilenumber.min' => 'The Mobile number must be at least :min characters.',
        'mobilenumber.max' => 'The Mobile number not be greater than :max characters.',
    ], [
        'min' => ':attribute must be at least :min characters.',
        'max' => ':attribute not be greater than :max characters.',
    ]);



    $branch = Branch::find($id);
    $branch->name = $request->input('name');
    $branch->location = $request->input('location');
    $branch->mobilenumber = $request->input('mobilenumber');
    $branch->password = $request->input('pass');
    $branch->apikey = $request->input('apikey');







    $branch->update();
    return redirect(route('viewbranch', ['id' => $id]));
  }









  public function deletebranch($id)
  {
    $branch = Branch::find($id);

      if (  $branch) {
        $branch->delete();
      return redirect(route('branch'))->with('status', "Data deleted successfully.");
     } else {
     return redirect(route('branch'))->with('error', "Data not found or already deleted.");
       }
}



























    function branchowners()
    {
        $branchownerdata = Owners::all()->reverse();
         return view('branchowners.branchowners',compact('branchownerdata'));
    }




    function createbranchowners()
{
    // Retrieve all users and branches
    $userdata = User::all()->reverse();

    // Ensure $branchdata is defined and accessible
    $branchdataall = Branch::all()->reverse();

    // Filter out branches that are already associated with owners
    $branchdata = $branchdataall->reject(function ($branch) {
        // Check if the branch ID exists in the owners' branch column
        return Owners::where('branch', $branch->id)->exists();
    });

    // Pass filtered branches to the view
    return view('branchowners.createbranchowners', compact('userdata', 'branchdata'));
}




public function createbranchownerspost(Request $request)
{
    $request->validate([
        'branch_name' => 'required|string',
        'owner_ids' => 'required|array', // Change validation to expect an array
        'owner_ids.*' => 'required|string', // Ensure each element in the array is a string
    ]);

    $branchName = $request->input('branch_name');
    $ownerIds = $request->input('owner_ids'); // Retrieve owner IDs from the form

    // Convert the array of owner IDs to a comma-separated string
    $commaSeparatedOwnerIds = implode(',', $ownerIds);

    // Create a new record in the Owners model
    Owners::create([
        'branch' => $branchName,
        'owners' => $commaSeparatedOwnerIds, // Store the comma-separated string of owner IDs
    ]);

    return redirect(route('branchowners'))->with("success");
}
































}
