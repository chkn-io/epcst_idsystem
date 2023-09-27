@extends('layouts.rfid')

@section('content')
<div class="col-md-8 p-3 pt-4 banner" >
    <img width="100px" src="{{asset('img/logo.png')}}" class="float-start me-3" alt="">
    <h2 class="float-start">
        EASTWOODS Professional College <br>
        <span class="text-muted" style="font-size:15pt;">of Science and Technology</span>
    </h2>
    <br>
    <hr style="width:80%;float:left;">
    <br>
    <p id="on-duty" class="float-start text-success">Guard on Duty: {{auth()->user()->name}}</p>
    <div class="clearfix"></div>
    <div>
        <a href="{{url('home')}}" class="btn btn-success float-end  ms-2">Logs</a> 
        <a href="{{ route('logout') }}" class="btn btn-danger float-end" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                <i class="fas fa-arrow-right"></i>
                <span>{{ __('Logout') }}</span>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a> 
    </div>
</div>
<div class="col-md-4 bg-dark text-white p-3">
    <p id="time">00:00 PM</p>
    <p id="date" class="text-warning">January 19, 2023 | Thursday</p>
</div>

<div class="col-md-12 bg-white p-3">
    <div class="row">
        <div class="col-md-5">
            <p class="text-center">
                <img width="90%" id="profile-image"  class="img-thumbnail mt-4" src="{{asset('img/default.png')}}" alt="Employee Picture">
            </p>
        </div>
        <div class="col-md-7" id="loading">
            <p class="text-center">
                <img width="80%" src="{{asset('img/loading.gif')}}" alt="Loading">
            </p>
        </div>
        <div class="col-md-7"  id="norecord-view">
            <h1 class="text-center text-muted mt-5">
                <img width="80%" src="{{asset('img/norecord.gif')}}" alt="RFID Scanning">
            </h1>
        </div>
        <div class="col-md-7"  id="default-view">
            <h1 class="text-center text-muted mt-5">
                Please Tap Your RFID
                <img width="70%" src="{{asset('img/rfid-scanning.gif')}}" alt="RFID Scanning">
            </h1>
        </div>
        <div class="col-md-7 tran-details" id="details-view">
            <p class="text-end text-success" id="id_number">16-005</p>
            <p class="text-end" id="employee_name">Percian Joseph Borja</p>
            <p class="text-end text-success" id="time_type">TIME IN</p>
            <p class="text-end" id="trans_time">8:00 AM</p>
        </div>
        
    </div>
</div>
@endsection
