<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use App\Models\Owners;
use Illuminate\Support\Facades\Hash;

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
            'mobilenumber.unique' => 'The Mobile number has already been taken, login now.',
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
            'code' => 'required',
            'location' => 'required',
            'apikey' => 'required',
            'mobilenumber' => 'required|string|min:10|max:10|unique:users',
        ], [

            'mobilenumber.min' => 'The Mobile number must be at least :min characters.',
            'mobilenumber.max' => 'The Mobile number not be greater than :max characters.',
            'mobilenumber.unique' => 'The Mobile number has already been taken, login now.',
        ], [
            'min' => ':attribute must be at least :min characters.',
            'max' => ':attribute not be greater than :max characters.',
        ]);






        $data['name'] = $request->name;
        $data['code'] = $request->code;
        $data['location'] = $request->location;
        $data['apikey'] = $request->apikey;
        $data['mobilenumber'] = $request->mobilenumber;
        $user = Branch::create($data);



        if (!$user) {
            return redirect(route('createbranch'))->with("error", "register failed, Try again");
        }
        return redirect(route('branch'))->with("success");
    }






















    function branchowners()
    {
        $branchownerdata = Owners::all()->reverse();
         return view('branchowners.branchowners',compact('branchownerdata'));
    }




    function  createbranchowners()
    {
        $userdata = User::all()->reverse();
        $branchdata = Branch::all()->reverse();
        return view('branchowners.createbranchowners',compact('userdata','branchdata'));
    }




    public function createbranchownerspost(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string', // Ensure it's a string
            'owner_id' => 'required|array',
            'owner_id.*' => 'exists:users,id', // Assuming users is your users table
        ]);

        $branchName = $request->input('branch_name');
        $ownerIds = $request->input('owner_id');

        // Convert array to comma-separated string
        $ownerIdsString = implode(',', $ownerIds);

        // Assuming you want to create a new record in the Owners model
        Owners::create([
            'branch' => $branchName, // Save the branch name directly
            'owners' => $ownerIdsString, // Store the string in the database
        ]);

        return redirect(route('branchowners'))->with("success");
    }














}
