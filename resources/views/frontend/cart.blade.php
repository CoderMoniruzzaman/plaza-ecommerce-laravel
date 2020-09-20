@extends('layouts/frontendapp')

@section('frontend_content')

<!-- Page Info -->
	<div class="page-info-section page-info">
		<div class="container">
			<div class="site-breadcrumb">
				<a href="">Home</a> /
				<a href="">Sales</a> /
				<a href="">Bags</a> /
				<span>Cart</span>
			</div>
			<img src="img/page-info-art.png" alt="" class="page-info-art">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area cart-page spad">
		<div class="container">
			<div class="cart-table">
				<form action="{{ url('update/cart')}}" method="post">
					@csrf

				<table>
					<thead>
						<tr>
							<th class="product-th">Product</th>
							<th>Price</th>
							<th>Quantity</th>
							<th class="total-th">Total</th>
						</tr>
					</thead>
					<tbody>
						@php
							$sub_total= 0;
						@endphp
            @forelse($cart_items as $cart_item)
              <tr>
                <td class="product-col">
                  <img src="img/product/cart.jpg" alt="">
                  <div class="pc-title">
                    <img src="{{ asset('uploads/product_photos')}}/{{ App\Product::find($cart_item->product_id)->product_image}}" alt="not found" width="50">
                    <h4>{{ App\Product::find($cart_item->product_id)->product_name}}</h4>
                    @if(App\Product::find($cart_item->product_id)->product_quantity== 0)
                      <div class="alert alert-danger">
                        Please Delete this
                      </div>
                    @endif
                    <a href="{{ url('delete/from/cart')}}/{{$cart_item->id}}">Delete Product</a>
                  </div>
                </td>
                <td class="price-col">${{ App\Product::find($cart_item->product_id)->product_price}}</td>
                <td class="quy-col">
                  <div class="quy-input">
                    <span>Qty</span>
										  <input type="hidden" value="{{ $cart_item->product_id}}" name="product_id[]">
                    <input type="number" value="{{ $cart_item->product_quantity}}" name="product_quantity[]">
                  </div>
                </td>
                <td class="total-col">
									${{ (App\Product::find($cart_item->product_id)->product_price)*$cart_item->product_quantity}}
									@php
										$sub_total= $sub_total + ((App\Product::find($cart_item->product_id)->product_price)*$cart_item->product_quantity);
									@endphp
								</td>
              </tr>
            @empty

              <tr>
                <td>
                  No Product to Show!!!
                </td>
              </tr>

            @endforelse

					</tbody>
				</table>
			</div>
			<div class="row cart-buttons">
				<div class="col-lg-5 col-md-5">
					<a href="{{ url('/')}}"><div class="site-btn btn-continue">Continue shooping</div></a>
				</div>
				<div class="col-lg-7 col-md-7 text-lg-right text-left">
					<a href="{{ url('clear/cart')}}"><div class="site-btn btn-clear">Clear cart</div></a>
					<button type="submit" class="site-btn btn-line btn-update">Update Cart</button>
				</div>
				</form>
			</div>
		</div>
		<div class="card-warp">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="shipping-info">
							<h4>Shipping method</h4>
							<p>Select the one you want</p>
							<div class="shipping-chooes">
								<div class="sc-item">
									<input type="radio" name="sc" id="one">
									<label for="one" id="sm_one">Next day delivery<span>$4.99</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="two">
									<label for="two" id="sm_two">Standard delivery<span>$1.99</span></label>
								</div>
								<div class="sc-item">
									<input type="radio" name="sc" id="three">
									<label for="three" id="sm_three">Personal Pickup<span>Free</span></label>
								</div>
							</div>
							<h4>Cupon code</h4>
							<p>Enter your cupone code</p>
							<div class="cupon-input">
								<input type="text" id="coupon_code_input_field" value="{{$coupon_name}}">
								<button class="site-btn" id="apply_btn">Apply</button>
							</div>
						</div>
					</div>
					<div class="offset-lg-2 col-lg-6">
						<div class="cart-total-details">
							<h4>Cart total</h4>
							<p>Final Info</p>
							<ul class="cart-total-card">
								<li>Subtotal<span>${{ $sub_total }}</span></li>
								<li>Shipping <span id="shipping_amount">0</span><span>$</span></li>
								<li>Discount Percentage ({{$coupon_percentage}})% <span>${{ $sub_total*($coupon_percentage/100)}}</span></li>
								<li class="total">Total<span id="total_amount_show">{{$sub_total-($sub_total*($coupon_percentage/100)) }}</span> <span>$</span></li>
								<span id="total_amount" style="display: none">{{$sub_total-($sub_total*($coupon_percentage/100)) }}</span>
							</ul>
							<form action="{{ url('checkout')}}" method="post">
								@csrf
								<input type="hidden" name="final_total_amount" value="{{$sub_total-($sub_total*($coupon_percentage/100)) }}">
								<button type="submit" class="site-btn btn-full" >Proceed to checkout</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page end -->
@endsection

	@section('footer_scripts')
	<script>

	$(document).ready(function(){
		$('#apply_btn').click(function(){
			var coupon_code = $('#coupon_code_input_field').val();
			var link_to_go = "{{ url('cart')}}/"+coupon_code;
			window.location.href = link_to_go;
		});
	});
	$('#sm_one').click(function(){
		$('#shipping_amount').html(4.99);
		var total_amount =  parseFloat($('#total_amount').html())+parseFloat(4.99);
		$('#total_amount_show').html(total_amount);
	});
	$('#sm_two').click(function(){
		$('#shipping_amount').html(1.99);
		var total_amount =  parseFloat($('#total_amount').html())+parseFloat(1.99);
		$('#total_amount_show').html(total_amount);
	});
	$('#sm_three').click(function(){
		$('#shipping_amount').html(0);
		var total_amount =  parseFloat($('#total_amount').html())+parseFloat(0);
		$('#total_amount_show').html(total_amount);
	});
	</script>

@endsection
