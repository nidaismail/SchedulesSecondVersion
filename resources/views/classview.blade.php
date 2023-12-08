@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/dashboardstyles.css" rel="stylesheet" />
<link href="images/favicon.png" rel="icon" type="image/png"> 


    <!-- Favicon -->
  
    <!-- Icons -->
   
    <!-- CSS Files -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}

    
    {{-- {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    .filterable {
  margin-top: 1.5rem;
  margin-bottom: 1.5rem;
  margin-left: 1rem;
  margin-right: 1rem
}
.filterable .panel-heading .pull-right {
  margin-top: -20px;
}
.filterable .filters input[disabled] {
  background-color: transparent;
  border: none;
  cursor: auto;
  box-shadow: none;
  padding: 0;
  height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
  color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
  color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
  color: #333;
}

    </style>


  
@endpush

@push('scripts')
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<script>
    /*
    Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
    */
    
    
    
    $(document).ready(function() {
    
      $('input[type=date]').change(function () {
        this.form.submit();
      });
    
        $('.filterable .btn-filter').click(function() {
            var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });
        $('.filterable .filters input').keyup(function(e) {
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function() {
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table
                    .find('.filters th').length + '">No result found</td></tr>'));
            }
        });
    });
    </script>
@endpush
@section('content')


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
                        <h1 class="mt-4">Class Activity</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Class Data
                                
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="panel panel-primary filterable">
                                        <div class="panel-heading">
                                          
                                            <div class="col pull-right text-right">
                                          
                                                <button style="background-color: #1BA998; color: #fff;" class="btn btn-primary btn-sm btn-filter"><span
                                                        class="glyphicon glyphicon-filter"></span> Filter</button>
                                            </div>
                                            
                                            <h3 class="mb-10 panel-title"></h3>
                                        </div>
                                        
                                        <table  class=" table table-bordered table-responsive" >
                                            @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                            <thead class="sticky-top">
                                                <tr class="filters">
                                                                {{-- <th><input type="text" class="form-control" placeholder="Date" disabled></th> --}}
                                                                <th><input type="text" class="form-control" placeholder="Class" disabled></th>
                                                                <th><b><input type="text" class="form-control" placeholder="Date" disabled></b></th>
                                                                <th><input type="text" class="form-control" placeholder="Day"disabled></th>
                                                                <th><input type="text" class="form-control" placeholder="Time From"disabled></th>
                                                                <th><input type="text" class="form-control" placeholder="Time To" disabled></th>
                                                                <th><input type="text" class="form-control" placeholder="Person" disabled></th>
                                                                <th><input type="text" class="form-control" placeholder="Activity" disabled></th>
                                                                
                                                                <th><input type="text" class="form-control" placeholder="Location" disabled></th>
                                                                <th><input type="text" class="form-control" placeholder="Remarks" disabled></th>
                                                                <th><input type="text" class="form-control" placeholder="Non-Admissible" disabled></th>
                                                                <th><input type="text" class="form-control" placeholder="Delete" disabled></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $groupedData = $schedules->groupBy(function ($item) {
                                                                    return $item->date . $item->time_from . $item->time_to . $item->location . $item->activity . $item->remarks;
                                                                });
                                                            @endphp
                                                            @foreach ($groupedData as $group)
                                                                <tr>
                                                                    <td>{{ $group[0]->class->class_name }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($group[0]->date)->format('d F, Y') }}</td>
                                                                    <td>{{ $group[0]->day }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($group[0]->time_from)->format('h:i A') }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($group[0]->time_to)->format('h:i A') }}</td>
                                                                    <td>
                                                                        @foreach ($group as $data)
                                                                            {{ $data->user->name }}
                                                                            @if (!$loop->last)
                                                                                <br>
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{ $group[0]->activity->activity_name }}</td>
                                                                    <td>{{ $group[0]->location->location }}</td>
                                                                    <td>{{ $group[0]->remarks }}</td>
                                                                    <td>
                                                                        <!-- Default switch -->
                                                                        <?php
                        
                                                                        $checked =  $data->admissible==1 ? 'checked="checked"' : 'nooo'?>
                                                                        <div class="form-check form-switch">
                                                                            <input data-id="{{$data->id}}" {{$checked}}
                                                                                class="flexSwitchCheckDefault form-check-input" name="toggle"
                                                                                type="checkbox" role="switch" class="" />
                                                                            <label class="form-check-label"
                                                                                for="flexSwitchCheckDefault"></label>
                                                                        </div></td><td>
                                                                            <a href="{{ url('delete', $group[0]->id) }}" class="delete-button" style="color: #1BA998;">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </a>
                                                                        </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                       
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success rounded-3 justify-content-center mar"
                                            id="btn-save" >Save
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