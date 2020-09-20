@extends('layouts\frontendapp');

@section('frontend_content')
<!-- Page Info -->
<div class="page-info-section page-info">
<div class="container">
  <div class="site-breadcrumb">
    <a href="">Home</a> /
    <a href="">Sales</a> /
    <a href="">Bags</a> /
    <a href="">Cart</a> /
    <span>Checkout</span>
  </div>
  <img src="img/page-info-art.png" alt="" class="page-info-art">
</div>
</div>
<!-- Page Info end -->

<!-- Page -->
<div class="page-area cart-page spad">
<div class="container">
  <form class="checkout-form">
    <div class="row">
      <div class="col-lg-6">
        @auth
        <h4 class="checkout-title">Billing/Shipping Address</h4>
        <div class="row">
          <div class="col-md-12">
            <input type="text" placeholder="Full Name *" value="{{ Auth::user()->name}}" name="full_name">
          </div>
          <div class="col-md-12">
            <input type="text" placeholder="Address *" value="{{ $customer_profile->address}}" name="address">
            <input type="text" placeholder="Company"  value="{{ $customer_profile->company}}" name="company">

            <select id="country" name="country_id">
              <option>Country *</option>
              @foreach($all_countries as $country)
                  <option value="{{ $country->id}}">{{ $country->name}}</option>
              @endforeach

            </select>

            <select id="city" name="city_id">
              <option>City/Town *</option>
            </select>
            <input type="text" placeholder="Zipcode *"  value="{{ $customer_profile->zip_code}}" name="zip_code">
            <input type="text" placeholder="Phone no *"  value="{{ $customer_profile->phone_number}}" name="phone_number">
            <input type="email" placeholder="Email Address *" value="{{ Auth::user()->email }}" name="email_address">
            <div class="checkbox-items">
              <div class="ci-item">
                <input type="checkbox" name="a" id="tandc">
                <label for="tandc">Terms and conditions</label>
              </div>
              <div class="ci-item">
                <input type="checkbox" name="c" id="newsletter">
                <label for="newsletter">Subscribe to our newsletter</label>
              </div>
            </div>
          </div>
        </div>
        @else
          <h4 class="checkout-title">Please LogIn to Continue.</h4>
          <a href="{{ url('login')}}">LogIn</a>
        @endauth
        </div>
      <div class="col-lg-6">
        <div class="order-card">
          <div class="order-details">
            <div class="od-warp">
              <h4 class="checkout-title">Your order</h4>
              <table class="order-table">

                  <tr class="order-total">
                    <th>Total</th>
                    <th>${{ $final_total_amount}}</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="payment-method">
              <div class="pm-item">
                <input type="radio" name="pm" id="one">
                <label for="one">Paypal</label>
              </div>
              <div class="pm-item">
                <input type="radio" name="pm" id="two">
                <label for="two">Cash on delievery</label>
              </div>
              <div class="pm-item">
                <input type="radio" name="pm" id="three">
                <label for="three">Credit card</label>
              </div>
              <div class="pm-item">
                <input type="radio" name="pm" id="four" checked>
                <label for="four">Direct bank transfer</label>
              </div>
            </div>
          </div>
          <button class="site-btn btn-full">Place Order</button>
        </div>
      </div>
    </div>
  </form>
</div>
</div>
<!-- Page -->
@endsection
@section('footer_scripts')
<script>
  $(document).ready(function(){
    $('#country').change(function(){
      var country_id = $(this).val();

      //ajax setup start
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      //ajax setup end
      //ajax request start
      $.ajax({
        type: 'POST',
        url: '/get/city/list',
        data: {country_id: country_id},
        success: function (data){
          $('#city').html(data);
        }
      });
      //ajax request end

    });
  });

</script>
@endsection
