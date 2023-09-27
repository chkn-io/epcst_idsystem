@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>System Reports</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item active">Reports</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12 gen">
            <div class="card">
                <div class="card-header">{{ __('Generate Reports') }}</div>

                <div class="card-body">
                    <form>
                        @csrf
                        <input type="hidden" name="list">
                        <div class="mb-3 mt-1">
                          <label style="width:100%" for="name" class="form-label">Enter employee name(s) / Select All to generate all the employee DTR 
                            <button type="button" class="float-end btn btn-danger btn-sm clear">Clear</button>
                          </label>
                          <select name="name" id="name" class="form-control">
                                <option value=""> ------------------ Please select name(s) ------------------ </option>
                                <option value="0">All</option>
                            @foreach($records as $record)
                                <option value="{{$record->id}}">{{$record->last_name}}, {{$record->first_name}} {{$record->middle_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="selected border border-success p-2 rounded">
                           <p class="text-center text-success mt-3">Please select names above</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 mt-1">
                                <label for="from" class="form-label">From</label>
                                <input type="date" name="from" class="form-control" id="from" value="2023-09-25">
                            </div>
                            <div class="col-md-6 mb-3 mt-1">
                                <label for="to" class="form-label">To</label>
                                <input type="date" name="to" class="form-control" id="to" value="2023-09-28">
                            </div>
                        </div>
                        <div class="mb-3 mt-1">
                            <button type="button" class="btn btn-primary generate">Generate</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>

        
        <div class="col-md-12 report-generated" hidden>
            <div class="card">
                <div class="card-header">
                    DTR From January 1, 2022 - January 31, 2022
                    <button class="btn btn-primary float-end btn-sm print"><i class="fas fa-print"></i> Print</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="text-primary text-center mb-5">Generating Report. Please Wait.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
