@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Departments</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item active">Departments</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('New Department')}}</div>
                <div class="card-body">
                    <h5>Enter new department details below </h5>
                    <form action="{{ route('departments.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-6" >
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="name" class="form-label">Department Name <span class="text-danger">*</span>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ old('name') }}" required class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Department Name" name="name">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="code" class="form-label">Department Code <span class="text-danger">*</span>
                                            @error('code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" value="{{ old('code') }}" required class="form-control @error('code') is-invalid @enderror" id="code" placeholder="Enter Department Code" name="code">
                                    </div>

                                    
                                    <button class="btn btn-success">Add Record</button>
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
                            {{-- @foreach($employees as $employee)
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
                            @endforeach --}}
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
