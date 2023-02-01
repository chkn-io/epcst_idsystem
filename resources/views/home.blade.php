@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Dashboard
        <input  type="date" class="form-control float-end" id="date-picker" style="width:30%">
    </h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Logs (<span class="text-primary"> {{ $date }} </span> )
                        <input type="text" placeholder="Search name here" style="width:30%" onkeyup="search_table()" class="form-control float-end" id="search-table">
                    </div>
                        <div class="card-body" style="height:35vh;overflow-y:scroll">
                            <table id="logs" class="table-bordered table-striped table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Name</th>
                                        <th>Snapshot</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                        <tr>
                                            <td>{{date('h:i:s A',strtotime($log->created_at))}}</td>
                                            <td>{{$log->last_name}}, {{$log->first_name}} {{$log->middle_name}}</td>
                                            <td><img width="120px" class="img-thumbnail" src="{{asset('images/'.$log->snapshot)}}" alt="{{$log->snapshot}}"></td>
                                            <td>{{$log->type == 'in' ? 'TIME IN':'TIME OUT'}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Time IN Logs (<span class="text-primary"> {{ $date }} </span> )</div>
                        <div class="card-body" style="height:35vh;overflow-y:scroll">
                            <table class="table-bordered table-striped table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                        @if($log->type == 'in')
                                            <tr>
                                                <td>{{date('h:i:s A',strtotime($log->created_at))}}</td>
                                                <td>{{$log->last_name}}, {{$log->first_name}} {{$log->middle_name}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Time OUT Logs (<span class="text-primary"> {{ $date }} </span> )</div>
                        <div class="card-body" style="height:35vh;overflow-y:scroll">
                            <table class="table-bordered table-striped table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                        @if($log->type == 'out')
                                            <tr>
                                                <td>{{date('h:i:s A',strtotime($log->created_at))}}</td>
                                                <td>{{$log->last_name}}, {{$log->first_name}} {{$log->middle_name}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Status (<span class="text-primary"> {{ $date }} </span> )</div>
                <div class="card-body status-body">
                    <ul class="list-group employee-status">
                        @foreach($status as $stat)
                            <li class="list-group-item border border-{{ $stat->status == '' ? 'danger' : ($stat->status == 'in' ? 'success':'danger') }} mb-1">
                                <span class="float-start">{{$stat->name}}</span>
                                <span class="float-end {{ $stat->status == '' ? 'out' : $stat->status}}"></span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function search_table() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-table");
    filter = input.value.toUpperCase();
    table = document.getElementById("logs");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
}
</script>
@endsection
