<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use App\Category;
use App\Contact;
Use Mail;
use App\Country;
use App\City;

use App\User;
use App\Customer_profile;
use Auth;
use App\Mail\ContactMessage;

class FrontendController extends Controller
{
    function contact(){
      return view('contact');
    }
    function about(){
      return view('about');
    }

    function contactinsert(Request $request){
      Contact::insert($request->except('_token'));
      //send mail to the Company

      $first_name= $request->first_name;
      $last_name= $request->last_name;
      $subject= $request->subject;
      $message= $request->message;

       Mail::to('rownakafrin@yahoo.com')->send(new ContactMessage($first_name,$last_name,$subject,$message));

      //return redirect('link here');
      //return back()->with('status','Message sent successfully!');
      return back()->withStatus('Message sent successfully!');
    }

    function index(){
      $products = Product::all();
      $categories = Category::all();
      return view('welcome', compact('products','categories'));
    }
    function productdetails($product_id){
      $single_product_info = Product::find($product_id);
      $related_products = Product::where('id', '!=',$product_id)->where('category_id',$single_product_info->category_id)->get();
      return view('frontend\productdetails', compact('single_product_info','related_products'));
    }
    function categorywiseproduct($category_id){
      $products = Product::where('category_id',$category_id)->get();
      return view('frontend/categorywiseproduct',compact('products'));
    }

    function addtocart($product_id){
      $ip_address = $_SERVER['REMOTE_ADDR'];

      if(Cart::where('customer_ip',$ip_address)->where('product_id',$product_id)->exists()){
          Cart::where('customer_ip',$ip_address)->where('product_id',$product_id)->increment('product_quantity',1);
      }
      else{
        Cart::insert([
          'customer_ip'=> $ip_address,
          'product_id'=> $product_id,
          'created_at'=> Carbon::now()
        ]);
      }
      return back();
    }


    function cart($coupon_name=""){
      if($coupon_name != ""){
        if(Coupon::where('coupon_name',$coupon_name)->exists()){

            if(Carbon::now()->format('Y-m-d') <= Carbon::create(Coupon::where('coupon_name',$coupon_name)->first()->valid_till)->format('Y-m-d') ){
              $coupon_percentage = Coupon::where('coupon_name',$coupon_name)->first()->coupon_percentage;
              $cart_items = Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->get();
              return view('frontend/cart', compact('cart_items','coupon_percentage','coupon_name'));
            }
            else{
              echo "Date Over!";
            }
         }
         else{
           echo "nai";
         }
      }
      else{
        $coupon_percentage = 0;
        $cart_items = Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->get();
        return view('frontend/cart', compact('cart_items','coupon_percentage','coupon_name'));
      }
    }

    function deletefromcart($cart_id){

      Cart::find($cart_id)->delete();
      return back();
    }

    function clearcart(){
       Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->delete();
       return back();
    }
    function updatecart(Request $request){
      foreach($request->product_id as $product_id_Key=> $product_id_value){
        echo $product_id_value."<br>";
        echo $request->product_quantity[$product_id_Key]."<br>";

        if($request->product_quantity[$product_id_Key] > 0){
          if($request->product_quantity[$product_id_Key] <= Product::find($product_id_value)->product_quantity){
            Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->where('product_id',$product_id_value)->update([
              'product_quantity' => $request->product_quantity[$product_id_Key]
            ]);
          }
          else{
            echo "nai";
          }
        }
        else{
          echo "minus";
        }
      }
      return back();

    }

    public function customerregistration(){
      return view('frontend/customerregistration');
    }

    public function customerregistrationinsert(Request $request){
        User::insert([
          'name' => $request->name,
          'email' => $request->email,
          'role' => 2,
          'password' => bcrypt($request->password),
          'created_at' => Carbon::now()
        ]);
        echo "Your Customer Account has been created!";
      }

      function checkout(Request $request){
        $final_total_amount = $request->final_total_amount;
        $customer_profile =  Customer_profile::where('user_id',Auth::id())->first();
        $all_countries= Country::all();
        return view('frontend/checkout',compact('final_total_amount','customer_profile','all_countries'));
      }
      function getcitylist(Request $request){

        $string_to_send = "";
        $cities =  City::where('country_id',$request->country_id)->get();
        foreach ($cities as $city) {
          $string_to_send .= "<option value='".$city->id."'>".$city->name."</option>";
        }
        echo $string_to_send;
      }
}
