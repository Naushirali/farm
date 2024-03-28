<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;



class Loginmanager extends Controller
{


    function login()
    {
         return view('loginregister.login');
    }




    function registration()
    {

         return view('loginregister.registration');
    }




    public function loginpost(Request $request)
    {
        $request->validate([
            'mobilenumber' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('mobilenumber', 'password');

        if (Auth::attempt($credentials)) {
            return redirect(route('welcome'));
        }

        return redirect(route('login'))
            ->withErrors(['error' => 'Incorrect Mobile number or password, pls try again.'])
            ->withInput();
    }







    function registrationpost(Request $request)
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
            return redirect(route('registration'))->with("error", "register failed, Try again");
        }
        return redirect(route('login'))->with("success", "login from here");
    }















    public function logout()
    {
       Session::flush();
       Auth::logout();
      return redirect(route('login'));

   }


}
