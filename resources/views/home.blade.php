@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="fonts/icomoon/style.css">
<link rel="stylesheet" href="css/classic.css">
<link rel="stylesheet" href="css/classic.date.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/alert.css">
<link href="images/favicon.png" rel="icon" type="image/png">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<!-- Icons -->
<link href="./js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
<link href="./js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
<style>
    .form-control{
        text-align: left;
    }
    .dropdown-menu{
        width: 100%;
        padding-left: 8px;
        padding-right: 8px
    }
    .dropdown-menu {
        width: 100%;
        padding: 10px;
        max-height: 200px;
        overflow-y: auto;
    }

    .dropdown-item {
        display: block;
        width: 100%;
        padding: 5px;
        color: #333;
        text-decoration: none;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .input-group {
        margin-bottom: 10px;
    }
</style>
@endpush

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add this script at the end of your HTML body -->
<script>
    $(document).ready(function() {
        // Check if jQuery is loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded!');
        } else {
            console.log('jQuery is loaded!');
        }

        // Check for errors in the document ready block
        try {
            // Update the selector to target the radio buttons inside the class-item2
            $('.class-item2 input[type="radio"]').change(function() {
                // Get the selected class name
                var selectedClassName = $(this).next('label').text();

                // Update the label of the dropdown button with the ID classDropdown2
                $('#classDropdown2').html(selectedClassName + ' <span class="caret"></span>');
            });
        } catch (error) {
            console.error('Error in document ready block:', error);
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add this script at the end of your HTML body -->
<script>
    $(document).ready(function() {
        // Check if jQuery is loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded!');
        } else {
            console.log('jQuery is loaded!');
        }

        // Check for errors in the document ready block
        try {
            // Update the selector to target the radio buttons inside the class-item
            $('.class-item input[type="radio"]').change(function() {
                // Get the selected class name
                var selectedClassName = $(this).next('label').text();

                // Update the label of the dropdown button with the selected class name
                $('#classDropdown').html(selectedClassName + ' <span class="caret"></span>');
            });
        } catch (error) {
            console.error('Error in document ready block:', error);
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('.class-item input[type="checkbox"]');
        var selectedClassInput = document.getElementById('selectedClass');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                var selectedClass = checkbox.parentElement.querySelector('label').innerText;

                // Update the input field with the selected class name
                selectedClassInput.value = selectedClass;
            });
        });
    });
</script>
<script>
function validate() {
    var valid = false;
    if (document.getElementById("dow1").checked) {
        valid = true;
    } else if (document.getElementById("dow2").checked) {
        valid = true;
    } else if (document.getElementById("dow3").checked) {
        valid = true;
    } else if (document.getElementById("dow4").checked) {
        valid = true;
    } else if (document.getElementById("dow5").checked) {
        valid = true;
    } else if (document.getElementById("dow6").checked) {
        valid = true;
    } else if (document.getElementById("dow7").checked) {
        valid = true;
    }
    if (valid) {
        console.log("done");
    } else {
        document.getElementById("alert").style.display = "block";
        return false;
    }
}
// This is for removing the div tag after a schedule is added ahh its a pop up actually or a better an alert. 
setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 4000);
// $('#alert').fadeOut('fast');
// }, 4000);
</script>
<script>
$(document).ready(function () {
    // Custom jQuery contains case-insensitive
    $.expr[":"].contains = $.expr.createPseudo(function (arg) {
        return function (elem) {
            return $(elem).text().toLowerCase().indexOf(arg.toLowerCase()) >= 0;
        };
    });

    // Search for persons in the dropdown
    $('#personSearch1, #personSearch2').on('input', function () {
        var searchQuery = $(this).val().toLowerCase();
        // Find the dropdown container
        var dropdownContainer = $(this).closest('.dropdown');
        // Find and hide all .person-item elements within the dropdown container
        dropdownContainer.find('.person-item').hide();
        // Find and show .person-item elements containing the search query
        dropdownContainer.find('.person-item:contains("' + searchQuery + '")').show();
    });

    // Search for classes in the dropdown
    $('#classSearch, #classSearch2').on('input', function () {
        var searchQuery = $(this).val().toLowerCase();
        // Find the dropdown container
        var dropdownContainer = $(this).closest('.dropdown');
        // Find and hide all .class-item elements within the dropdown container
        dropdownContainer.find('.class-item, .class-item2').hide();
        // Find and show .class-item elements containing the search query
        dropdownContainer.find('.class-item:contains("' + searchQuery + '"), .class-item2:contains("' + searchQuery + '")').show();
    });
});
    
</script>
@endpush


@section('content')

<div class="">
    @if (session('status'))
    <div class="alert alert-success" role="alert">

        {{ session('status') }}
    </div>
    @endif


    <form class="myform" method="POST" action="{{ route('save') }}" onsubmit="return validate();">
        @csrf
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                <div class="content">
                    <div class="container text-left">
                        <div class="row p-4 justify-content-center" id="successMessage">
                            @if(session()->has('success'))
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle"></i>
                                {{ session()->get('success') }}
                            </div>
                            @endif
                        
                            @if(session()->has('error'))
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-circle"></i>
                                {{ session()->get('error') }}
                            </div>
                            @endif
                            @error('persons')
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div id="alert" class="error-msg" role="alert">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <span style="">
                                Please Select a Day.
                            </span>
                        </div>
                        <div class="row justify-content-center given-mar">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_from">Select</label>
                                            <input type="radio" id="id" value="Class" name="category" class="pad">
                                            <label for="" class="cat">Class</label>
                                            <input type="radio" id="ids" value="Person" name="category"
                                                checked="checked">
                                            <label for="" class="cat">Person</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 removed" id="displayPerson">
                                <div class="form-group">
                                    <div class="dropdown">
                                        <button class="form-control dropdown-toggle" type="button" id="personsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Select Persons
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="personsDropdown">
                                            @role('admin')
                                                <input type="text" id="personSearch1" class="form-control" placeholder="Search Persons...">
                                                @foreach($persons as $person)
                                                    <div class="form-check person-item">
                                                        <input type="checkbox" name="persons[]" id="person_{{ $person->userID }}" value="{{ $person->userID }}" class="form-check-input">
                                                        <label class="form-check-label" for="person_{{ $person->userID }}">{{ $person->name }}</label>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach($persons as $person)
                                                    <div class="form-check person-item">
                                                        <input type="checkbox" name="persons[]" id="person_{{ $person->userID }}" value="{{ $person->userID }}" class="form-check-input">
                                                        <label class="form-check-label" for="person_{{ $person->userID }}">{{ $person->name }}</label>
                                                    </div>
                                                @endforeach
                                        @endrole
                                                        </div>
                                                    </div>
                                                    </div>
                            </div>
                                                    <div class="col-md-6 removedClass" id="displayClass">
                            <div class="form-group">
                                <div class="dropdown">
                                    <button class="form-control dropdown-toggle" type="button" id="classDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Class
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="classDropdown">
                                        <input type="text" id="classSearch" class="form-control" placeholder="Search Classes...">
                                        @foreach($clas as $cl)
                                            <div class="form-check class-item">
                                                <input type="radio" name="class" id="class_{{ $cl->id }}" value="{{ $cl->id }}" class="form-check-input">
                                                <label class="form-check-label" for="class_{{ $cl->id }}">{{ $cl->class_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div> 
                        <div class="row">
                            <div class="form-group">
                                <div class="dowPicker">
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow1" name="day[]" value="Sunday">
                                        <label for="dow1">Sun</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow2" name="day[]" value="Monday">
                                        <label for="dow2">Mon</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow3" name="day[]" value="Tuesday">
                                        <label for="dow3">Tue</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow4" name="day[]" value="Wednesday">
                                        <label for="dow4">Wed</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow5" name="day[]" value="Thursday">
                                        <label for="dow5">Thur</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow6" name="day[]" value="Friday">
                                        <label for="dow6">Fri</label>
                                    </div>
                                    <div class="dowPickerOption">
                                        <input type="checkbox" id="dow7" name="day[]" value="Saturday">
                                        <label for="dow7">Sat</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center given-mar">
                            <div class="col-lg-7">
                                <div action="#" class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_from">Date From</label>
                                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" min="0"
                                                name="start_date" class="form-control" id="start_date" placeholder=""
                                                required value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    {{-- @php
                                    $today = \Carbon\Carbon::now(); //Current Date and Time
                                   $lastDayofMonth =    \Carbon\Carbon::parse($today)->endOfMonth()->toDateString();
                                   dd($lastDayofMonth);
                                   @endphp --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_to">Date To</label>
                                            <input type="date" data-date="" data-date-format="DD MMMM YYYY"
                                                name="end_date" class="form-control" id="end_date"
                                                placeholder="End Date" required
                                                value="<?php echo date('Y-m-t', strtotime('0 months')); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center given-mar">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_from">Time From</label>
                                            <input type="time" name="start_time" class="form-control"
                                                id="start_time" value="08:00" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input_to">Time To</label>
                                            <input type="time" name="end_time" class="form-control"
                                                id="end_time" value="16:00" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center given-mar">
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="activity">Activity</label>
                                            <select name="activity" id="" class="form-control" id="activity" required>
                                                <option value="" disabled selected>Select Activity</option>
                                                @foreach($activities as $act)
                                                <option value='{{$act->id}}'>{{$act->activity_name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <select name="location" id="location" class="form-control" required>
                                                <option value="" disabled selected>Select Location</option>
                                                @foreach($locations as $loc)
                                                <option value='{{$loc->id}}'>{{$loc->location}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                    <div class="col-md-6 hidden" id="showPerson">
                                    <label for="Persons[]">Person</label>
                                    <div class="form-group">
                                            <div class="dropdown">
                                                <button class="form-control dropdown-toggle" type="button" id="personsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Persons
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="personsDropdown">
                                                    @role('admin')
                                                        <input type="text" id="personSearch2" class="form-control" placeholder="Search Persons...">
                                                        @foreach($persons as $person)
                                                            <div class="form-check person-item">
                                                                <input type="checkbox" name="persons[]" id="person_{{ $person->userID }}" value="{{ $person->userID }}" class="form-check-input">
                                                                <label class="form-check-label" for="person_{{ $person->userID }}">{{ $person->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        @foreach($persons as $person)
                                                            <div class="form-check person-item">
                                                                <input type="checkbox" name="persons[]" id="person_{{ $person->userID }}" value="{{ $person->userID }}" class="form-check-input">
                                                                <label class="form-check-label" for="person_{{ $person->userID }}">{{ $person->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endrole
                                                </div>
                                            </div>
                                                                            </div>
                                    </div>
                                  
                                                                        <div class="col-md-6 hiddenClass" id="showClass">
                                                            <div class="form-group">
                                                                <label for="class">Class</label>
                                                                <div class="dropdown">
                                                                    <button class="form-control dropdown-toggle" type="button" id="classDropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" name="remarks" id="" class="form-control" required>
                                        </div>
                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-">
                                <div class="row">
                                    <div style="padding-top: 10px" class="col-md-4 col-sm-12">
                                        <a href="{{ route('save') }}" id="schedule-form"> <button type="submit"
                                                class="btn btn-success rounded-3 justify-content-center">Submit
                                            </button></a>

                                    </div>
                                    <div style="padding-top: 10px" class="col-md-4 col-sm-12">
                                        <input type="reset" class="btn btn-success rounded-3 justify-content-center "
                                            name="Reset">
                                    </div>
                                    <div style="padding-top: 10px" class="col-md-4 col-sm-12">
                                        <a href="{{ route('viewdata') }}"> <button type="button"
                                                class="btn btn-success rounded-3 justify-content-center">Preview</button></a>
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


</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
</div>
@endif

{{ __('You are logged in!') }}
</div>
</div>
</div>
</div>
</div> --}}
@endsection
@push('script')

@endpush

@prepend('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function() {
    $('.person-input').change(function() {
        $('.person-input').val($(this).val())
    })
    $('.class-input').change(function() {
        $('.class-input').val($(this).val())
    })
    $("div.hidden").hide();
    $("div.removedClass").hide();
    $('#pers').prop('required', true);
    $('#cls').prop('required', false);
    $('#pers2').prop('required', false);
    $('#cls2').prop('required', true);
    // $("#display" + divalue).show();
    //         $("div.removed").not($("#display" + divalue)).hide();
    //         $("#show" + divalue).hide();
    //         $("div.hidden").not($("#show" + divalue)).show();

    $('input:radio[name="category"]').on('change', function() {
        var divalue = $(this).val();
        if (divalue == "") {
            $("div.hidden").hide();
            $("div.removed").hide();

        } else if (divalue == "Person") {
            $('#pers').prop('disabled', false);
            $('#cls').prop('disabled', false);
            $("#display" + divalue).show();
            $('#pers').prop('required', true);
            $('#cls').prop('required', false);
            $('#pers2').prop('required', false);
            $('#cls2').prop('required', true);

            // $("#ids").prop( "checked", false );
            $('#cls').prop('disabled', 'disabled');
            $("div.removedClass").not($("#display" + divalue)).hide();
            $("#show" + divalue).hide();
            $("#show" + divalue).prop('disabled', 'disabled');
            $("div.hiddenClass").not($("#show" + divalue)).show();
        } else if (divalue == "Class") {
            $('#pers').prop('disabled', false);
            $('#cls').prop('disabled', false);
            $('#cls').prop('required', true);
            $('#pers').prop('required', false);
            $('#pers2').prop('required', true);
            $('#cls2').prop('required', false);
            $("#display" + divalue).show();
            // $("#id").prop( "checked", false );
            $('#pers').prop('disabled', 'disabled');
            $("div.removed").not($("#display" + divalue)).hide();
            $("#show" + divalue).hide();
            $("div.hidden").not($("#show" + divalue)).show();
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#location').on('change', function() {

        var locationId = $(this).val();
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var startTime = $('#start_time').val();
        var endTime = $('#end_time').val();
        var selectedDays = [];
        $("input[name='day[]']:checked").each(function(index, obj) {
            selectedDays.push($(obj).val())
        });
        //'check-location-availability'
        $.ajax({
            url: '{{ route('check-location-availability') }}',
            method: 'POST',
            data: {
                location_id: locationId,
                start_date: startDate,
                end_date: endDate,
                start_time: startTime,
                end_time: endTime,
                selectedDays: JSON.stringify(selectedDays)
            },
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                }
            }
        });
    });

    $("input").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format(this.getAttribute("data-date-format"))
        )
    }).trigger("change")



});
</script>
@endprepend
