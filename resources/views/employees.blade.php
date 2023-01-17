@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Employees</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item active">Employees</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('New Employee')}}</div>
                <div class="card-body">
                    <h5>Enter new employee details below </h5>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="employee_number" class="form-label">Employee Number</label>
                                        <input type="text" required class="form-control" id="employee_number" placeholder="Enter Employee #" name="employee_number">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" required class="form-control" id="first_name" placeholder="Enter First Name" name="first_name">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="middle_name" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middle_name" placeholder="Enter Middle Name" name="middle_name">
                                    </div>

                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" required class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="rfid" class="form-label">RFID Number</label>
                                        <input type="text" required class="form-control" id="rfid" placeholder="Scan RFID" name="rfid">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row justify-content-around">
                                        <div class="mb-3 mt-3 col-md-6">
                                            <figcaption>
                                                <img width="100%" src="{{ asset('img/default.png') }}" id="pic-preview" alt="">
                                            </figcaption>
                                            <input type="file" onchange="loadFile(event)" required class="form-control" id="picture" name="picture" accept="image/*" required>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-success">Add Record</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Employee List') }}
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Employee Number</th>
                                <th>Name</th>
                                <th>Picture</th>
                                <th>RFID</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->employee_number}}</td>
                                    <td>{{$employee->last_name}},
                                        {{$employee->first_name}} 
                                        {{$employee->middle_name}}
                                    </td>
                                    <td>
                                        @if($employee->picture === "" )
                                            <img width="100px" class="img-thumbnail" src="{{asset('img/default.png')}}" alt="Default Picture">
                                        @else
                                            <img src="{{asset('img/default.png')}}" alt="Default Picture">
                                        @endif
                                    </td>
                                    <td>{{$employee->rfid == '' ? 'Not Available':$employee->rfid}}</td>
                                    <td><span class="badge {{ $employee->status == 'active' ? 'bg-success':'bg-danger' }}">{{$employee->status}}</span></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Update</button>
                                        <button class="btn btn-sm {{ $employee->status == 'active' ? 'btn-warning':'btn-success' }}">
                                            {{ $employee->status == 'active' ? 'De-activate':'Activate' }}
                                        </button> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal" id="new-employee">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Employee</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('pic-preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
@endsection
