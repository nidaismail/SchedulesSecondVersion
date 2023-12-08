<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Scheduling System</title>
    <link rel="icon" href="{{ url('images/favicon.jpg') }}">

    <!-- Icons font CSS-->
    <link href="asset/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="asset/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="asset/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="asset/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    
    <link rel="stylesheet" href="{{ asset('asset/css/main.css') }}">
    <style>
   
      #alert{
  display: none;
    }
    .error-msg,
    .warning-msg {
    width: 340px;
    margin: 10px 5px;
    padding: 10px;
    border-radius: 8px 4px 4px 4px;
    }
    .error-msg {
    color: #9F6000;
    background-color: #FEEFB3;
    }
    .warning-msg {
    color: #D8000C;
    background-color: #FFBABA;
    }
      input {
        width: 100%;
        box-sizing: border-box;
        color:"white";
        }
        input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        }
      
        body
         {background-color: #1BA998;
       


    align-content: center;
    }  .form-group {
        margin-bottom: 20px;
    }

    .input-label {
        display: block;
        margin-bottom: 5px;
        font-size: 16px;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    /* Custom styling for dropdowns */
    .form-control select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 30px; /* Adjust the value based on your design */
        background: url('path-to-your-arrow-icon.png') no-repeat right center; /* Replace with your arrow icon */
    }
    #successMessage .alert-success {
        background-color: #1BA998;
        border-color: #ffeeba;
        color: white;
    }

    #successMessage .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

        </style>
    
</head>

<div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Update</h2>
                <form action="{{ url('/edit/' . $schedule->id) }}" method="POST">
                    @csrf
                    <div class="row p-4 justify-content-center" id="successMessage">
                    @if(session()->has('success') || $errors->any())
                        <div class="alert {{ $errors->any() ? 'alert-danger' : 'alert-success' }} error-msg">
                            <i class="{{ $errors->any() ? 'fa fa-exclamation-circle' : 'fa fa-check-circle' }}"></i>
                            {{ $errors->any() ? 'Error: ' : '' }}
                            @if(session()->has('success'))
                                {{ session()->get('success') }}
                            @elseif($errors->any())
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif
                </div>

                    <div class="form-group">
                    <label for="user_id" class="input-label">Person</label>
                    <select id="user_id" class="form-control" name="user_id">
                        @foreach ($users as $user)
                            <option value="{{ $user->userID }}" {{ $schedule->user->userID == $user->userID ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="location_id" class="input-label">Location</label>
                    <select id="location_id" class="form-control" name="location_id">
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" {{ $schedule->location->id == $location->id ? 'selected' : '' }}>
                                {{ $location->location }}
                            </option>
                        @endforeach
                    </select>
                </div>
                    <br>
                    <br>
                    <br>
                      <div>
                    <button style="padding: 10px 20px; background-color: #1BA998; color: white; line-height: 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; text-decoration: none;">
                        Update
                    </button>
                    <br>
                    <br>
                    <button style="padding: 10px 20px; background-color: #1BA998; color: white; line-height: 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; text-decoration: none;">
                        <span style="margin-right: 5px; font-size: 12px; line-height: 12px;">&#8592;</span> <a href="{{ url('admin') }}">Go Back</a>
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
     
    <!-- Jquery JS-->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="asset/vendor/select2/select2.min.js"></script>
    <script src="asset/vendor/datepicker/moment.min.js"></script>
    <script src="asset/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="asset/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->