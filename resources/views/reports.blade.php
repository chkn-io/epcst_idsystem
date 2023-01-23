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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Generate Reports') }}</div>

                <div class="card-body">
                    <form action="/action_page.php">
                        @csrf
                        <div class="mb-3 mt-1">
                          <label for="name" class="form-label">Enter employee name(s) / Select All to generate all the employee DTR</label>
                          <select name="name" id="name" class="form-control">
                            @foreach($records as $record)
                                <option value="{{$record->id}}">{{$record->last_name}}, {{$record->first_name}} {{$record->middle_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="selected border border-success p-2 rounded">
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 mt-1">
                                <label for="from" class="form-label">From</label>
                                <input type="date" name="from" class="form-control" id="from">
                            </div>
                            <div class="col-md-6 mb-3 mt-1">
                                <label for="to" class="form-label">To</label>
                                <input type="date" name="to" class="form-control" id="to">
                            </div>
                        </div>
                        <div class="mb-3 mt-1">
                            <button class="btn btn-primary">Generate</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
