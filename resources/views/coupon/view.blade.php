@extends('layouts/app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-8">
      <div class="card mb-3">
        <div class="card-header bg-success">
          List Contact Message
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
                <th>Coupon Name</th>
                <th>Coupon Percentage</th>
                <th>Valid Till</th>
                <th>Created At</th>
              <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
              @forelse($coupons as $coupon)
              <tr>
                <td>{{ $loop->index + 1}}</td>


                <td>{{ $coupon -> coupon_name }}</td>
                <td>{{ $coupon -> coupon_percentage }}</td>
                <td>{{ $coupon -> valid_till }}</td>
                <td>{{ $coupon -> created_at }}</td>
              </tr>
              @empty
                <tr class="text-center text-danger">
                  <td colspan="9">No Data Available</td>
                </tr>
              @endforelse

            </tbody>

          </table>
        </div>
      </div>

    </div>
    <div class="col-4">
      <div class="card mb-3">
        <div class="card-header bg-success">
          Add Coupon
        </div>
        <div class="card-body">
          @if($errors->all())
            <div class="alert alert-danger" role='alert'>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          @endif

          @if (session('deletestatus'))
            <div class="alert alert-danger">
              {{ session('deletestatus') }}
            </div>
          @endif
          <form action="{{ url('coupon/insert')}}" method="post" enctype="multipart/form-data">
          <!-- {{ csrf_field() }} -old version  -->
            @csrf
            <div class="form-group">
              <label>Coupon Name</label>
              <input type="text" class="form-control" placeholder="Enter Coupon name" name="coupon_name">
            </div>
            <div class="form-group">
              <label>Coupon Percentage (%)</label>
              <input type="text" class="form-control" placeholder="Enter Percentage" name="coupon_percentage">
            </div>
            <div class="form-group">
              <label>Valid Till</label>
              <input type="date" class="form-control" name="valid_till">
            </div>
            <button type="submit" class="btn btn-success">Add Coupon</button>
          </form>

        </div>
      </div>

    </div>

  </div>

</div>

@endsection
