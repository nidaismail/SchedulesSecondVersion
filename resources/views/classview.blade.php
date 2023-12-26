@extends('layouts.app')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/dashboardstyles.css" rel="stylesheet" />
<link href="images/favicon.png" rel="icon" type="image/png"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}

    
    {{-- {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
  $(document).ready(function () {
    $('#deleteSelectedButton').on('click', function (event) {
        event.preventDefault();
        var selectedRows = $('#dataTable').find('input[type=checkbox]:checked').closest('tr');
        var selectedIds = selectedRows.map(function () {
            return $(this).find('input[type=checkbox]').data('id');
        }).get();

        if (selectedIds.length > 0) {
            var confirmation = confirm('Are you sure you want to delete selected record(s)?');
            if (confirmation) {
                deleteRecords(selectedIds, selectedRows); // Pass selected rows for removal
            }
        } else {
            alert('Please select at least one record to delete.');
        }
    });

    function deleteRecords(ids, rowsToRemove) {
        $.ajax({
            url: '/delete/' + ids.join(','),
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.hasOwnProperty('success')) {
                    displayMessage(response.success, 'success');
                    // Remove deleted rows from the table
                    rowsToRemove.remove(); // Remove selected rows from the table
                } else {
                    displayMessage(response.error, 'error');
                }
            },
            error: function (xhr) {
                displayMessage('Failed to Delete Records', 'error');
            }
        });
    }

    function displayMessage(message, type) {
        var messageBox = '<div class="alert alert-' + type + '">' + message + '</div>';
        $('#messageContainer').html(messageBox);
        // Automatically remove the message after 3 seconds
        setTimeout(function () {
            $('#messageContainer').empty();
        }, 3000);
    }
});
    </script>
    <script>
        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            const individualCheckboxes = document.querySelectorAll('.individualCheckbox');
        
            individualCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
       
    
        // Your existing JavaScript code
       
    </script>
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
.filter-options {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.filter-options label {
    font-weight: bold;
    margin-right: 5px;
}

.filter-options input[type="date"],
.filter-options select {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 14px;
    width: 150px;
}

        /* Custom styling for the select dropdown */
        .form-group {
            text-align: center;
        }
        #classSelection {
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%; /* Adjust the width as needed */
            box-sizing: border-box;
            /* Additional styles to prevent cutoff */
            height: 40px; /* Adjust the height as needed */
            appearance: none; /* Remove default arrow icon in some browsers */
            -webkit-appearance: none; /* For Safari/Chrome */
            -moz-appearance: none; /* For Firefox */
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%23333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 18px 18px;
        }

        /* Responsive styles for smaller screens */
        @media screen and (max-width: 768px) {
            #classSelection {
                height: auto; /* Set height to auto for smaller screens */
                max-height: 150px; /* Limit max height for scrollable dropdown */
                overflow-y: auto; /* Enable vertical scrollbar if needed */
            }
        }
    </style>


  
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const classSelectionInput = document.getElementById('classSelection');
        const tableRows = document.querySelectorAll('#dataTable tbody tr');

        // Initially hide all table rows
        tableRows.forEach(function(row) {
            row.style.display = 'none';
        });

        function applyFilters() {
            const startDate = startDateInput.value ? new Date(startDateInput.value) : null;
            const endDate = endDateInput.value ? new Date(endDateInput.value) : null;
            const selectedClass = classSelectionInput.value.toLowerCase();

            let allConditionsMet = startDate && endDate && selectedClass !== '';

            tableRows.forEach(function(row) {
                const rowDate = new Date(row.cells[1].innerText); // Assuming date is in the second column
                const rowClass = row.cells[0].innerText.toLowerCase(); // Assuming class name is in the first column

                const showByDate = (!startDate || !endDate || (rowDate >= startDate && rowDate <= endDate));
                const showByClass = (selectedClass === '' || rowClass === selectedClass);

                if (allConditionsMet && showByDate && showByClass) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        startDateInput.addEventListener('change', applyFilters);
        endDateInput.addEventListener('change', applyFilters);
        classSelectionInput.addEventListener('change', applyFilters);
    });
</script>
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<script>
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
                                        <div class="container mt-4">
                                        <div>
                                        <div class="panel-body">
        <div class="panel-heading">
            <div class="container">
                <div class="rounded-3 text-center">
                    <div class="content">
                        <div class="container text-left">
                            <div class="row justify-content-center given-mar">
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="startDate" style="color: #1BA998; font-size: 16px; font-weight: bold; text-transform: uppercase;">Date From</label>
                                                <input type="date" style="background-color: #1BA998; color:white; font-weight: bold; "data-date="" data-date-format="DD MMMM YYYY" min="0" name="start_date" class="form-control" id="startDate" placeholder="" style="" required value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="endDate" style="color: #1BA998; font-size: 16px; padding-left:14px; font-weight: bold; text-transform: uppercase;">Date To</label>
                                                <input type="date" style="background-color: #1BA998; color:white; font-weight: bold; " data-date="" data-date-format="DD MMMM YYYY" name="end_date" class="form-control" id="endDate" placeholder="End Date" required value="<?php echo date('Y-m-t', strtotime('0 months')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-center">
                                                <label for="classSelection" style="color: #1BA998; font-size: 16px; font-weight: bold; text-transform: uppercase;">Filter by Class:</label>
                                                <select  id="classSelection" class="form-control">
                                                    <option  value="">Select a Class</option>
                                                    <!-- Embedding PHP data into HTML -->
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->class_name }}">{{ $class->class_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Other content -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                        <table  class=" table table-bordered table-responsive" id="dataTable" >
                                            <div id="messageContainer"></div>
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
                                                                <th style="font-size:9px">
                                                                    <div  style="text-align: center; width: 120%; height: 120%; background-color: white;"class="select-all">
                                                                      <input style="text-align: center;" type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll()">
                                                                      <!-- <span style="text-align: center;" class="select-symbol">&#10003;</span> -->
                                                                    </div>
                                                                  </th>
                                                                
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
                                                                            <input type="checkbox" class="individualCheckbox">
                                                                        </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <button id="deleteSelectedButton" class="btn btn-danger">Delete Selected</button>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        
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