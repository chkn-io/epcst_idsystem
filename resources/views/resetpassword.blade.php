@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <h1>Users</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item active">Reset Password</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Reset Password')}}</div>
                <div class="card-body">
                    <form action="{{ route('reset_password',$user[0]->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                        @elseif (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error') }}
                                            </div> 
                                        @endif
                                <div class="col-md-6" >
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="name" class="form-label">New Password<span class="text-danger">*</label>
                                        <input type="password" required value="" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Enter New Password" name="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                    </div>
                                    <div class="mb-3 mt-3 col-md-12">
                                        <label for="email" class="form-label">Confirm Password<span class="text-danger">*</label>
                                        <input type="password" required value="" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="Enter Confirm Password" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row justify-content-around">
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-success">Reset Password</button>
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
