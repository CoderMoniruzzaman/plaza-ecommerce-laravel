<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Contact;
use App\Coupon;
use App\Category;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function index()
    {
        $all_users = User::all();

        return view('home',compact('all_users'));
    }
    public function contactmessageview()
    {
        $contactmessages = Contact::all();

        return view('contact/view',compact('contactmessages'));
    }
    public function changemenustatus($category_id)
    {
      // if(Category::find($category_id)->menu_status==0){
      //     Category::find($category_id)->update([
      //       'menu_status'=> true
      //     ]);
      // }else{
      //     Category::find($category_id)->update([
      //       'menu_status'=> false
      //     ]);
      // }

      $category_info = Category::find($category_id);
      if($category_info->menu_status== 0){
        $category_info->menu_status = true;
      }
      else{
        $category_info->menu_status = false;

      }
      $category_info->save();
          return back();
    }
    function addcouponview(){
      $coupons = Coupon::all();
      return view('coupon/view', compact('coupons'));
    }

}
