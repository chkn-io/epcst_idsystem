@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Update Employee Details</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/employees')}}">Employees</a></li>
        <li class="breadcrumb-item active">Update</li>
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
                    <form action="/employees/update/{{$employee[0]->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="employee_number" class="form-label">Employee Number <span class="text-danger">*</span>
                                            @error('employee_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ $employee[0]->employee_number }}" required class="form-control @error('employee_number') is-invalid @enderror" id="employee_number" placeholder="Enter Employee #" name="employee_number">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span>
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ $employee[0]->first_name }}" required class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter First Name" name="first_name">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="middle_name" class="form-label">Middle Name
                                            @error('middle_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ $employee[0]->middle_name }}" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" placeholder="Enter Middle Name" name="middle_name">
                                    </div>

                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span>
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ $employee[0]->last_name }}" required class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Enter Last Name" name="last_name">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="rfid" class="form-label">RFID Number
                                            @error('rfid')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input value="{{ $employee[0]->rfid }}" type="text" class="form-control @error('rfid') is-invalid @enderror" id="rfid" placeholder="Scan RFID" name="rfid">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row justify-content-around">
                                        <div class="mb-3 mt-3 col-md-6">
                                            <figcaption>
                                                <img width="100%" src="{{ asset(''.$employee[0]->picture.'') }}" id="pic-preview" alt="">
                                            </figcaption>
                                            <input value="{{ old('picture') }}" type="file" onchange="loadFile(event)" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" accept="image/*" >
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-success">Update Record</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
