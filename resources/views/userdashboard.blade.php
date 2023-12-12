@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/dashboardstyles.css" rel="stylesheet" />
<link href="images/favicon.png" rel="icon" type="image/png"> 
@endpush

@push('scripts')
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

@endpush
@section('content')

<div class="">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="">
        {{-- <nav class="sb-topnav navbar navbar-expand navbar-dark align">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav> --}}
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="{{ route('viewdata') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Person Activity
                            </a>
                            <a class="nav-link" href="{{ route('view') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Class Activity
                            </a>
                            <a class="nav-link" href="{{ route('home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Home
                            </a>
                        </div>
                    </div>

                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <h1 class="mt-4">Person Activity</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Employees Data
                            </div>
                            <form class="" method="GET" action="/getSchedules">
                                @csrf
                                <div class="container ">
                                    <div class=" rounded-3 text-center">
                                        <div class="content">
                                            <div class="container text-left">
                                                <div class="row justify-content-center given-mar">
                                                    <div class="col-lg-10">
                                                        <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="input_from" style="color: grey; font-size: 16px;  font-weight: bold; text-transform: uppercase;">Date From</label>
                                                                        <input type="date" data-date="" data-date-format="DD MMMM YYYY" min="0"
                                                                            name="start_date" class="form-control" id="start_date" placeholder="" style=""
                                                                            required value="<?php echo date('Y-m-d'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="input_to" style="color: grey;  font-size: 16px; padding-left:14px; font-weight: bold; text-transform: uppercase;">Date To</label>
                                                                        <input type="date" data-date="" data-date-format="DD MMMM YYYY"
                                                                            name="end_date" class="form-control" id="end_date"
                                                                            placeholder="End Date" required
                                                                            value="<?php echo date('Y-m-t', strtotime('0 months')); ?>">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4"> 
                                                                <div class="form-group">
                                                                    <div class="dropdown" >
                                                                        <button class="btn btn-success form-control dropdown-toggle btn-block" type="button" id="classDropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="margin-top: 1.8rem;">
                                                                            Select Class
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="classDropdown2">
                                                                            <input type="text" id="classSearch2" class="form-control" placeholder="Search Classes...">
                                                                            @foreach($clas as $cl)
                                                                                <div class="form-check class-item2">
                                                                                    <input type="radio" name="class" id="class_{{ $cl->id }}" value="{{ $cl->id }}" class="form-check-input">
                                                                                    <label class="form-check-label" for="class_{{ $cl->id }}">{{ $cl->class_name }}</label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <button type="submit" class="btn btn-success rounded-3  btn-block" style="margin-top: 1.8rem ; margin-left: 2.8rem;">Get Schedules</button>
                                                                </div>
                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="panel panel-primary filterable">
                                        <div class="panel-heading">
                                            
                                            <div class="card-body">
                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <table class="table table-bordered table-responsive" id="persontable">
                                                        <thead>
                                                            <tr>
                                                                <th width="200px">Date</th>
                                                                <th width="150px">Day</th>
                                                                <th width="150px">Time From</th>
                                                                <th width="150px">Time To</th>
                                                                <th width="150px">Person</th>
                                                                <th width="150px">Activity</th>
                                                                <th width="150px">Class</th>
                                                                <th width="250px">Location</th>
                                                                <th width="150px">Remarks</th>
                                                                <th width="150px">Non-Admissible</th>
                                                                <th width="150px">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($schedules as $data)
                                                                <tr>
                                                                    <td>{{ \Carbon\Carbon::parse($data->date)->format('d F, Y') }}</td>
                                                                    <td>{{$data->day}}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($data->time_from)->format('h:i A') }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($data->time_to)->format('h:i A') }}</td>
                                                                    <td>{{$data->user->name}} </td>
                                                                    <td>{{$data->activity->activity_name}} </td>
                                                                    <td>{{$data->class->class_name}} </td>
                                                                    <td>{{$data->location->location}} </td>
                                                                    <td>{{$data->remarks}}</td>
                                                                    <td>
                                                                    <a href="{{ url('delete', $data->id) }}" class="delete-button" style="color: #1BA998;">
                                                                        <i class="fas fa-trash-alt"></i></td>
                                                                    </a>
                                                                    <td>
                                                                        <?php
                                                                        $checked =  $data->admissible==1 ? 'checked="checked"' : 'nooo'?>
                                                                        <div class="form-check form-switch">
                                                                            <input data-id="{{$data->id}}" {{$checked}}
                                                                                class="flexSwitchCheckDefault form-check-input" name="toggle"
                                                                                type="checkbox" role="switch" class="" />
                                                                            <label class="form-check-label"
                                                                                for="flexSwitchCheckDefault"></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                
                                                    <!-- <table class="table table-bordered table-responsive" id="classtable" style="display: none";>
                                                        <thead>
                                                            <tr>
                                                                <th width="150px">Class</th>
                                                                <th width="200px">Date</th>
                                                                <th width="150px">Day</th>
                                                                <th width="150px">Time From</th>
                                                                <th width="150px">Time To</th>
                                                                <th width="150px">Person</th>
                                                                <th width="150px">Activity</th>
                                                                <th width="250px">Location</th>
                                                                <th width="150px">Remarks</th>
                                                                <th width="150px">Non-Admissible</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    </table> -->
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success rounded-3 justify-content-center mar"
                                            id="btn-save">Save
                                        </button>
                                    </div>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@prepend('scripts')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script>
$(document).ready(function() {
    $('#btn-save').on('click', function(e) {

        e.preventDefault();
        const schedule_id = [];
        const persondata_id = [];


        $('.flexSwitchCheckDefault').each(function(el) {
            if ($(this).is(":checked")) {
                schedule_id.push($(this).attr('data-id'));
            }
        })


        $.ajax({
            url: '/admissible',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                schedule_id: schedule_id

            },
            success: function(reponse) {

            }
        })
    });
})


</script>
@endprepend