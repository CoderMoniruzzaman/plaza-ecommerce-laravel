@extends('layouts/app')

@section('content')
<div class="container">
  <div class="row">

    <div class="col-6 offset-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('add/product/view')}}">Product List</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$single_product_info->product_name}}</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header bg-success">
          Edit Product Form
        </div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <form action="{{ url('edit/product/insert')}}" method="post" enctype="multipart/form-data">
          <!-- {{ csrf_field() }} -old version  -->
            @csrf
            <div class="form-group">
              <label>Product Name</label>
              <input type="hidden" name="product_id" value="{{ $single_product_info->id }}">
              <input type="text" class="form-control" placeholder="Enter your product name" name="product_name" value= "{{$single_product_info->product_name}}">
            </div>
            <div class="form-group">
              <label>Product Description</label>
              <textarea class="form-control" rows="3" name="product_desc">{{$single_product_info->product_desc}}</textarea>
            </div>
            <div class="form-group">
              <label>Product Price</label>
              <input type="text" class="form-control" placeholder="Enter your product price" name="product_price" value= "{{$single_product_info->product_price}}">
            </div>
            <div class="form-group">
              <label>Product Quantity</label>
              <input type="text" class="form-control" placeholder="Enter your product quantity" name="product_quantity" value= "{{$single_product_info->product_quantity}}">
            </div>
            <div class="form-group">
              <label>Alert Quantity</label>
              <input type="text" class="form-control" placeholder="Enter your product alert" name="alert_quantity" value= "{{$single_product_info->alert_quantity}}">
            </div>
            <div class="form-group">
              <label>Product Image</label>
              <input type="file" class="form-control"  name="product_image">
              <img src="{{ asset('uploads/product_photos')}}/{{ $single_product_info -> product_image }}" alt="not found" width="150">
            </div>


            <button type="submit" class="btn btn-warning">Edit Product</button>
          </form>
        </div>

      </div>

    </div>

  </div>

</div>

@endsection
