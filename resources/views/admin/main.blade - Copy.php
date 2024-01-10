<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Location Activity Dashboard
    </title>
    <!-- Favicon -->
    <link href="./images/favicon.png" rel="icon" type="image/png"> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="./css/argon-dash.css?v=1.1.2" rel="stylesheet" />
    
    {{-- {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
</head>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var locationFilter = document.getElementById('location-filter');
        var applyButton = document.getElementById('applyLocationFilterBtn');

        applyButton.addEventListener('click', function () {
            var selectedLocation = locationFilter.value;
            console.log('Selected Location:', selectedLocation);

            // Hide all rows initially
            var allRows = document.querySelectorAll('.location-row');
            allRows.forEach(function (row) {
                row.style.display = 'none';
            });

            // Show rows based on the selected location
            if (selectedLocation === '') {
                // If 'All Locations' is selected, show all rows
                allRows.forEach(function (row) {
                    row.style.display = '';
                });
            } else {
                // Show rows matching the selected location
                var selectedRows = document.querySelectorAll('.location-row-' + selectedLocation);
                selectedRows.forEach(function (row) {
                    row.style.display = '';
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#locationSearch').on('keyup', function() {
            var searchText = $(this).val().toLowerCase(); // Get the search text
            $('.location-item').each(function() {
                var locationText = $(this).text().toLowerCase(); // Get the location text
                var containsText = locationText.includes(searchText); // Check if location text contains search text
                $(this).toggle(containsText); // Show/hide based on search
            });
        });
    });
</script>
<body class="">
  <style>
       .dropdown-menu {
        max-height: 200px; /* Set max height to enable scrolling */
        overflow-y: auto; /* Enable vertical scrollbar */
    }

    /* WebKit-specific scrollbar styles */
    .dropdown-menu::-webkit-scrollbar {
        width: 8px; /* Width of the scrollbar */
    }

    .dropdown-menu::-webkit-scrollbar-track {
        background: #f1f1f1; /* Track color */
    }

    .dropdown-menu::-webkit-scrollbar-thumb {
        background-color: #888; /* Thumb color */
        border-radius: 10px; /* Rounded corners */
    }

    /* Hide the default scrollbar in other browsers */
    .dropdown-menu {
        scrollbar-width: thin; /* Firefox */
        scrollbar-color: #f1f1f1 #888; /* Firefox scrollbar color */
    }
    .body{}
    /* CSS to set the text color based on background color */
    td[data-color="red"] {
        background-color: red;
        color: white; /* Text color for red cells */
    }

    td[data-color="green"] {
        background-color: green;
        color: black; /* Text color for green cells */
    }
    .table-wrapper {
    overflow-x: auto; /* Enable horizontal scrolling */
    max-width: 100%; /* Ensure the table wrapper doesn't overflow */
    max-height: 600px;
    overflow-y: auto;
}

.table {
    border-collapse: collapse;
    width: 100%;
    table-layout: fixed; /* Important for fixed column width */
}

.static-column {
    position: sticky;
    left: 0;
    background-color: white;
    z-index: 1;
    /* Set width for the static columns */
    width: 170px; /* Adjust according to your needs */
    
}
.static-column + .static-column {
    margin-left: -1px; /* Adjust for any gap caused by default spacing */
}

.static-column:nth-child(2) {
    left: 171px;
    width: 280px;
}
.static-column:nth-child(3) {
    left: 320px;
    width: 310px;/* Adjust based on the width of the first static column */
   
}
.btn-custom {
    background-color: #16A796;
    color: #fff; /* Optionally, change text color to white */
}
.btn-custom:hover {
    color: #575151; /* Change text color to white on hover */
}
#locationDropdown + .dropdown-menu {
    width: 100%;
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
}

/* Style for the search input */
#locationSearch {
    width: calc(100% - 20px);
    margin-bottom: 10px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Style for individual location items */
.location-item {
    margin-bottom: 5px;
    display: flex;
    align-items: center;
}

/* Style for radio buttons */
.location-item input[type="radio"] {
    margin-right: 5px;
    transform: scale(1.2); /* Increase the radio button size */
}

/* Style for the labels of location items */
.location-item label {
    cursor: pointer;
}
</style>
      <header class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="https://www.anth.pk/" target="_blank">
                <img src="./images/brand/CIRS.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <!-- Collapse content -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="https://www.anth.pk/" target="_blank">
                            <img src="./images/brand/CIRS.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="d-flex">
                <a class="btn btn-custom" href="{{url('/home')}}">
                    <i class="ni ni-single-02 text-yellow"></i> Home
                </a>
                
                <a class="btn btn-custom mr-2" href="{{url('/classadmin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Class Activity
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/locationadmin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Campus Activity
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/getSchedules')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i>Monthly Schedule
                </a>
                <a class="btn btn-custom mr-2" href="{{url('/admin')}}" target="_self">
                    <i class="ni ni-key-25 text-info"></i> Person Activity
                </a>
            </div>
        </div>
    </header>
      <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
                    href="{{url('/admin')}}">Location Activity Dashboard</a>
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- Header -->
        <div class="header bg-gradient-primary pb-1 pt-5 pt-md-8">
            <div class="container-fluid">
               
            </div>
        </div>
        <div class="container-fluid mt--7">
            <div class="row mt-5">
                <div class="col-xl-12 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0 " style="padding-left: 3rem;">
                            <div class="row align-items-center">
                                <div class="col-md-12 text-center">
                                <div class="divs">
                                  
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                    <div class="panel-heading">
                    <form class="" method="GET" action="{{ url('otherFunctionality') }}">
                            @csrf
                            <div class="container ">
                                <div class=" rounded-3 text-center">
                                    <div class="content">
                                        <div class="container text-left">
                                            <div class="row justify-content-center given-mar">
                                                <div class="col-lg-10">
                                                    <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="input_from" style="color: grey; font-size: 16px;  font-weight: bold; text-transform: uppercase;">Date From</label>
                                                                    <input type="date" data-date="" data-date-format="DD MMMM YYYY" min="0"
                                                                        name="start_date" class="form-control" id="start_date" placeholder="" style=""
                                                                        required value="<?php echo date('Y-m-d'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-3">
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
                                                        <div class="col-md-4" style="padding-left: 0rem; "> 
                                                            <div class="form-group">
                                                            <div class="dropdown">
                                                            <button class="btn btn-success form-control dropdown-toggle btn-block" type="button" id="locationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 1.8rem;">
                                                                 Select location
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="locationDropdown" >
                                                                <input type="text" id="locationSearch" class="form-control" placeholder="Search Locations...">
                                                                @foreach($locations as $location)
                                                                    <div class="form-check location-item">
                                                                        <input type="radio" name="location" id="location_{{ $location->id }}" value="{{ $location->id }}" class="form-check-input me-2">
                                                                        <label class="form-check-label" for="location_{{ $location->id }}">{{ $location->location }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="submit" class="btn btn-success rounded-3  btn-block" style="margin-top: 1.8rem ; margin-left: 3.8rem;">Get Schedules</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col pull-right text-left">
                                <h3 class="mb-10 panel-title"></h3>
                            </div>
                            @if(isset($_GET['location']) && isset($_GET['start_date']) && isset($_GET['end_date']))
                            @php
                                $selectedLocationId = $_GET['location']; // Retrieve the selected location ID from URL parameter
                                // Assuming $locations is the collection/array of all locations
                                $selectedLocation = $locations->firstWhere('id', $selectedLocationId); // Find the selected location by ID
                                $startDate = $_GET['start_date'];
                                $endDate = $_GET['end_date'];
                            @endphp
                        
                            <div class="schedule-header">
                                @if($selectedLocation)
                                    <p style="text-align: center; margin:1rem;">
                                        <span style="font-weight: bold;">
                                            Schedules for <span style="color:#2DCE89;"> {{ $selectedLocation->location }}</span> 
                                            From <span style="color:#2DCE89;">{{ date('d-m-Y', strtotime($startDate)) }} </span> To <span style="color:#2DCE89;">{{ date('d-m-Y', strtotime($endDate)) }}
                                        </span>
                                    </p>
                                @endif
                        
                                <div class="table-wrapper">
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 12px; font-weight: bold">Date</th>
                                                <th style="font-size: 12px; font-weight: bold">Utility</th>
                                                
                                                <!-- Headers for intervals -->
                                                @foreach ($timeIntervals as $interval)
                                                    @php
                                                        [$startTime, $endTime] = explode(' - ', $interval); // Splitting start and end times
                                                    @endphp
                                                    <th style="padding-right: 0.5rem; padding-left:0.6rem; font-size: 12px; font-weight: bold">
                                                        <div>{{ $startTime }} </div>
                                                        <div>{{ $endTime }}</div>
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $selectedDates = $selectedDates ?? []; // Initialize $selectedDates if it's undefined
                                            @endphp
                                            <!-- Rows for each date -->
                                            @foreach ($selectedDates as $date)
                                                <tr>
                                                    <td>
                                                        {{ date('d-m-Y', strtotime($date)) }} <br>
                                                        {{ date('l', strtotime($date)) }}
                                                    </td>
                                                    @php
                                                        // Initialize variables to hold occupied and unoccupied hours for each date
                                                        $occupiedHours = 0;
                                                        $unoccupiedHours = 0;
                                                        $intervalOccupancy = []; // Array to store interval occupancy data
                                                        $isWeekend = (date('N', strtotime($date)) >= 6); // Check if it's Saturday (6) or Sunday (7)
                
                                                    @endphp
                                                    @foreach ($timeIntervals as $interval)
                                                        @php
                                                            $cellData = $occupancyData[$date][$interval] ?? null;
                                                            $cellColor = $cellData['color'] ?? 'green'; // Default to green if data is not present
                                                            // Calculate occupied and unoccupied hours based on cell color
                                                            if ($cellColor === 'red') {
                                                                $occupiedHours += 0.25; // Assuming each interval represents 15 minutes (0.25 hours)
                                                            } else {
                                                                $unoccupiedHours += 0.25;
                                                            }
                                                            // Store occupancy data for each interval
                                                            $intervalOccupancy[] = [
                                                                'color' => $cellColor,
                                                                'details' => $cellData['details'] ?? '',
                                                            ];
                                                        @endphp
                                                    @endforeach
                                                    <!-- Display occupied and unoccupied hours before intervals -->
                                                    <td> <span style= "color:red; font-weight:bold;">{{ $occupiedHours }} </span><span style="font-weight:bold";>-</span><span style= "color:#24A884; font-weight:bold;"> {{ $unoccupiedHours }}</span></td>
                                                    
                                                    <!-- Render intervals with cell coloring -->
                                                    @foreach ($intervalOccupancy as $data)
                                                    @php
                                                        $cellColor = $data['color'];
                                                        // If it's a weekend, change the cell color to black
                                                        if ($isWeekend) {
                                                            $cellColor = 'black';
                                                        }
                                                    @endphp
                                                    <td style="background-color: {{ $cellColor }}" data-toggle="tooltip" title="{{ $data['details'] }}">
                                                        <!-- If the cell is occupied (red), display a tooltip -->
                                                        <!-- Tooltip will show the person's name and class -->
                                                    </td>
                                                @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <!--   Core   -->
    <script src="./js/plugins/jquery/dist/jquery.min.js"></script>
    <script src="./js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--   Optional JS   -->
    <script src="./js/plugins/chart.js/dist/Chart.min.js"></script>
    <script src="./js/plugins/chart.js/dist/Chart.extension.js"></script>
    <!--   Argon JS   -->
    <script src="./js/argon-dashboard.min.js?v=1.1.2"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        // Initialize Bootstrap tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
    $(document).ready(function() {
        $('#filter_date').change(function() {
            $('#filter_form').submit();
        })
       
    })
    window.TrackJS &&
        TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
        });
       
                 

                          
                      
    </script>
</body>

</html>