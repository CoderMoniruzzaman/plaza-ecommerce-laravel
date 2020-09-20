@extends('layouts/app')

@section('content')


<div class="container">
  <div class="row">
    <div class="col-12">
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Subject</th>
                <th>Message</th>
              <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
              @forelse($contactmessages as $contactmessage)
              <tr class="{{($contactmessage->read_status==1)?"bg-info":"" }}">
                <td>{{ $loop->index + 1}}</td>


                <td>{{ $contactmessage -> first_name }}</td>
                <td>{{ $contactmessage -> last_name }}</td>
                <td>{{ $contactmessage -> subject }}</td>
                <td>{{ $contactmessage -> message }}</td>

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


  </div>

</div>

@endsection
