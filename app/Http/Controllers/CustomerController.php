<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Customer_profile;
use Hash;
use Carbon\Carbon;

class CustomerController extends Controller
{
    function customerhome(){
      return view('customer/home');
    }

    function setorchangepassword(){
      return view('customer/changepassword');
    }

    function setpassword(Request $request){

      $request->validate([
        'new_password' => 'required|min:8',
        'confirm_password' => 'required',
        'confirm_password' => 'same:new_password'
      ]);

      User::find(Auth::id())->update([
        'password' => bcrypt($request->new_password )
      ]);
    //echo "new password set!";
    return back();
    }

    function changepassword(Request $request){

      if(Hash::check($request->old_password, Auth::user()->password)){
          $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required',
            'confirm_password' => 'same:new_password'
          ]);

          User::find(Auth::id())->update([
            'password' => bcrypt($request->new_password )
          ]);
      //  echo "new password set!";
        return back();
      }
      else{
        echo "mile nai";
      }
    }

    function myprofile(){
      return view('customer/profile');
    }

    function myprofileinsert(Request $request){

      Customer_profile::insert($request->except('_token') + [
        'user_id' => Auth::id(),
        'created_at' => Carbon::now()
      ]);
      return back();
    }

}
