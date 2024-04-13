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
                                        <label for="employee_number" class="form-label">Employee Number <span class="text-danger">*</span>
                                            @error('employee_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ old('employee_number') }}" required class="form-control @error('employee_number') is-invalid @enderror" id="employee_number" placeholder="Enter Employee #" name="employee_number">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span>
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ old('first_name') }}" required class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter First Name" name="first_name">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="middle_name" class="form-label">Middle Name
                                            @error('middle_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ old('middle_name') }}" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" placeholder="Enter Middle Name" name="middle_name">
                                    </div>

                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span>
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ old('last_name') }}" required class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Enter Last Name" name="last_name">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="type" class="form-label">Type <span class="text-danger">*</span>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <select required class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                            <option value="teacher">Teacher</option>
                                            <option value="student">Student</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="rfid" class="form-label">RFID Number
                                            @error('rfid')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input value="{{ old('rfid') }}" type="text" class="form-control @error('rfid') is-invalid @enderror" id="rfid" placeholder="Scan RFID" name="rfid">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row justify-content-around">
                                        <div class="mb-3 mt-3 col-md-6">
                                            <figcaption>
                                                <img width="100%" src="{{ asset('img/default.png') }}" id="pic-preview" alt="">
                                            </figcaption>
                                            <input type="file" onchange="loadFile(event)" required class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" accept="image/*" required>
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
                                <th>Type</th>
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
                                        @if($employee->picture != "" )
                                            <img width="100px" class="img-thumbnail" src="{{asset('' . $employee->picture . '')}}" alt="Default Picture">
                                        @else
                                            <img src="{{asset('img/default.png')}}" alt="Default Picture">
                                        @endif
                                    </td>
                                    <td>{{$employee->rfid == '' ? 'Not Available':$employee->rfid}}</td>
                                    <td>{{$employee->type}}</td>
                                    <td><span class="badge {{ $employee->status == 'active' ? 'bg-success':'bg-danger' }}">{{$employee->status}}</span></td>
                                    <td>
                                        <a href="{{url('employees/'.$employee->id.'')}}" class="btn btn-primary btn-sm">Update</a>
                                    <a href="{{url('employees/')}}" data-record="{{$employee->id}}" class="btn btn-sm {{ $employee->status == 'active' ? 'btn-warning deactivate':'btn-success activate' }}">
                                            {{ $employee->status == 'active' ? 'De-activate':'Activate' }}
                                        </a> 
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
