@extends('layouts/app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-9">
      <div class="card mb-3">
        <div class="card-header bg-success">
          Product List
        </div>
        <div class="card-body">
          @if (session('deletestatus'))
            <div class="alert alert-danger">
              {{ session('deletestatus') }}
            </div>
          @endif

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>SL. No</th>
                <th>Category Name</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Alert Quantity</th>
                <th>Product Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($products as $product)
              <tr>
                <td>{{ $loop->index + 1}}</td>
                 <!-- <td>{{ App\Category::find($product -> category_id)->category_name  }}</td>  -->
                 <td>{{ $product->relationtocategory->category_name}}</td>
                <td>{{ $product -> product_name }}</td>
                <td>{{ str_limit($product -> product_desc ,20)}}</td>
                <td>{{ $product -> product_price }}</td>
                <td>{{ $product -> product_quantity }}</td>
                <td>{{ $product -> alert_quantity }}</td>
                <td>
                  <img src="{{ asset('uploads/product_photos')}}/{{ $product -> product_image }}" alt="not found" width="50">
                </td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ url('edit/product')}}/{{ $product -> id}}" class="btn btn-info btn-sm"> Edit</button></a>
                  <a href="{{ url('delete/product')}}/{{ $product -> id}}" class="btn btn-danger btn-sm">Delete</button></a>
                  </div>

                </td>
              </tr>
              @empty
                <tr class="text-center text-danger">
                  <td colspan="9">No Data Available</td>
                </tr>
              @endforelse

            </tbody>

          </table>
          {{ $products -> links()}}
        </div>
      </div>
      <div class="card">
        <div class="card-header bg-danger">
          Deleted Products
        </div>
        <div class="card-body">
          @if (session('restorestatus'))
            <div class="alert alert-success">
              {{ session('restorestatus') }}
            </div>
          @endif
          @if (session('delstatus'))
            <div class="alert alert-danger">
              {{ session('delstatus') }}
            </div>
          @endif
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>SL. No</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Alert Quantity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($deleted_products as $deleted_product)
              <tr>
                <td>{{ $loop->index + 1}}</td>

                <td>{{ $deleted_product -> product_name }}</td>
                <td>{{ str_limit($deleted_product -> product_desc ,20)}}</td>
                <td>{{ $deleted_product -> product_price }}</td>
                <td>{{ $deleted_product -> product_quantity }}</td>
                <td>{{ $deleted_product -> alert_quantity }}</td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ url('restore/product')}}/{{ $deleted_product -> id}}" class="btn btn-success btn-sm"> Restore</button></a>
                  <a href="{{ url('force/delete/product')}}/{{ $deleted_product -> id}}" class="btn btn-danger btn-sm"> Permanent Delete</button></a>
                  </div>

                </td>
              </tr>
              @empty
                <tr class="text-center text-danger">
                  <td colspan="7">No Data Available</td>
                </tr>
              @endforelse

            </tbody>

          </table>
          {{ $products -> links()}}
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card">
        <div class="card-header bg-success">
          Add Product Form
        </div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          @if($errors->all())
            <div class="alert alert-danger">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach

            </div>
          @endif

          <form action="{{ url('add/product/insert')}}" method="post" enctype="multipart/form-data">
          <!-- {{ csrf_field() }} -old version  -->
            @csrf
            <div class="form-group">
              <label>Category Name</label>
              <select class="form-control" name="category_id">
                <option value="">--Select One--</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id}}">{{ $category->category_name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" placeholder="Enter your product name" name="product_name" value="{{ old('product_name')}}">
            </div>
            <div class="form-group">
              <label>Product Description</label>
              <textarea class="form-control" rows="3" name="product_desc">{{ old('product_desc')}}</textarea>
            </div>
            <div class="form-group">
              <label>Product Price</label>
              <input type="text" class="form-control" placeholder="Enter your product price" name="product_price" value="{{ old('product_price')}}">
            </div>
            <div class="form-group">
              <label>Product Quantity</label>
              <input type="text" class="form-control" placeholder="Enter your product quantity" name="product_quantity" value="{{ old('product_quantity')}}">
            </div>
            <div class="form-group">
              <label>Alert Quantity</label>
              <input type="text" class="form-control" placeholder="Enter your product alert" name="alert_quantity" value="{{ old('alert_quantity')}}">
            </div>
            <div class="form-group">
              <label>Product Image</label>
              <input type="file" class="form-control" name="product_image">
            </div>

            <button type="submit" class="btn btn-info">Add Product</button>
          </form>
        </div>

      </div>

    </div>

  </div>

</div>

@endsection
