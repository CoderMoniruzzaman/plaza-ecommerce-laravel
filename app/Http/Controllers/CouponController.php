<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function couponinsert(Request $request){
      $request->validate([
        'coupon_name' => 'required|unique:coupons,coupon_name',
        'coupon_percentage' => 'required|numeric|min:1|max:99',

      ]);

      if($request->valid_till >= Carbon::now()->format('Y-m-d')){
        Coupon::insert([
          'coupon_name' => $request->coupon_name,
          'coupon_percentage' => $request->coupon_percentage,
          'valid_till' => $request->valid_till,
          'created_at' => Carbon::now()
        ]);

        return back();
      }
      else{
        return back()->withErrors('Date is not correct!');
      }
    }
}
