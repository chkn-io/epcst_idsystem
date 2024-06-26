@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <h1>Users</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('New User')}}</div>
                <div class="card-body">
                    <h5>Enter new user details below </h5>
                    <form action="{{ route('update_data',$user[0]->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                 @if($errors->any())
                                        <ul class="alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <li> {{ $error }} </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                <div class="col-md-6" >
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</label>
                                        <input type="text" value="{{ $user[0]->name }} " class="form-control" id="name" placeholder="Enter First Name" name="name">
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="email" class="form-label">Username / RFID  <span class="text-danger">*</label>
                                        <input type="text" value="{{ $user[0]->email }}" class="form-control" id="email" placeholder="Enter Email" name="email">
                                    </div>
                                    {{-- <div class="mb-3 mt-3 col-md-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password"  value="{{ $user[0]->password }}" class="form-control" id="password" placeholder="Enter Password" name="password">
                                    </div> --}}
                                </div>
                                <div class="col-md-6">
                                    <div class="row justify-content-around">
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
@endsection
