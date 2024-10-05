@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Daily Time Records</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
        <li class="breadcrumb-item active">Daily Time Records</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12 gen">
            <div class="card">
                <div class="card-header">{{ __('Daily Time Records') }}</div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="employee_list">Select Employee</label>
                                    <select class="form-control employee_list" name="employee">
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->last_name}}, {{$employee->first_name}} {{$employee->middle_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="from">From</label>
                                    <input type="date" name="from" id="from" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="to">To</label>
                                    <input type="date" name="to" id="to" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-success" id="generate-dtr">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="section dtr_management">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12 gen">
            <div class="card">
                <div class="card-header">{{ __('DTR Management') }}</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2">Date</th>
                                <th colspan="2" class="text-center bg-warning">Time In</th>
                                <th colspan="2" class="text-center bg-primary text-white">Time Out</th>
                            </tr>
                            <tr>
                                <th>Snapshot</th>
                                <th>Timestamp</th>
                                <th>Snapshot</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>

                    <div class="mb-4">
                        <button class="btn btn-success" id="save-dtr">Save DTR</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
