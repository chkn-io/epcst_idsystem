@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Account</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item active">Change Password</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">{{ __('Change Password')}}</div>
                <div class="card-body">
                    <div class="panel-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                        <form class="form-horizontal" method="POST" action="./changePassword">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}   mt-3">
                                <label for="new-password" class="col-md-4 control-label">Current Password</label>
    
                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>
    
                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}  mt-3">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>
    
                                <div class="col-md-6 "">
                                    <input id="new-password" type="password" class="form-control" name="new-password" required>
    
                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group mt-3">
                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
    
                                <div class="col-md-6 ">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection