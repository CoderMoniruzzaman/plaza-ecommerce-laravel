@extends('layouts/app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-6 offset-3">
      <div class="card mb-6">
        <div class="card-header bg-info">
          My Profile
        </div>
        <div class="card-body">
          @if($errors->all())
            <div class="alert alert-danger" role="alert">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          @endif

          @if(App\Customer_profile::where('user_id', Auth::id())-> exists())
            Already Inserted
          @else
            <form action="{{ url('my/profile/insert')}}" method="post">
              @csrf
              <div class="form-group">
                <label>Company</label>
                <input type="text" class="form-control" placeholder="Enter Your Company Name" name="company">
              </div>
              <div class="form-group">
                <label>Address</label>
                  <textarea name="address" rows="5" class="form-control" placeholder="Enter Your Address"></textarea>
              </div>
              <div class="form-group">
                <label>Zip Code</label>
                <input type="text" class="form-control" placeholder="Enter Zip Code" name="zip_code">
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" placeholder="Enter Your Phone Number" name="phone_number">
              </div>
              <button type="submit" class="btn btn-success">Submit</button>
            </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
