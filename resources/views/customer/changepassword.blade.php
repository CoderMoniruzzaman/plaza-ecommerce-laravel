@extends('layouts/app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-6 offset-3">
      <div class="card mb-6">
        <div class="card-header bg-info">
          Set/Change Password
        </div>
        <div class="card-body">
          @if($errors->all())
            <div class="alert alert-danger" role="alert">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          @endif

          @if(Auth::user()->password == "SocialAccount")
            <form action="{{ url('set/password')}}" method="post">
              @csrf
              <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" placeholder="Enter Your New Password" name="new_password">
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirm_password">
              </div>
              <button type="submit" class="btn btn-success">Set Password</button>
            </form>
          @else
          <form action="{{ url('change/password')}}" method="post">
            @csrf
            <div class="form-group">
              <label>Old Password</label>
              <input type="password" class="form-control" placeholder="Enter Your Old Password" name="old_password">
            </div>
            <div class="form-group">
              <label>New Password</label>
              <input type="password" class="form-control" placeholder="Enter Your New Password" name="new_password">
            </div>
            <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirm_password">
            </div>
            <button type="submit" class="btn btn-success">Change Password</button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
