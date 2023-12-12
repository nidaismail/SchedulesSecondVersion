<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Location;
use App\Models\Grade;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function main(Request $request)
    { $classId = $request->input('class');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Fetch schedules based on the selected class, date range, and eager loading relationships
        $schedules = Schedule::with(['user', 'activity', 'location'])
            ->where('class_id', $classId)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->orderBy('time_from')
            ->get();
    
        // Fetch all classes for the class dropdown
       
        // Fetch all classes for the class dropdown
        $locations = Location::all()->sortBy('location');
    
        // Fetch the selected class
        $selectedClass = Grade::find($classId);
        if (!$request->has('userdate') || empty($request['userdate'])) {
            $request['userdate'] = now()->format('Y-m-d');
        }
        
        $clas = Grade::all()->sortBy(function ($clas) {
            return $clas->class_name;
        });
    
        $currentdate = Carbon::parse($request['userdate'])->format('Y-m-d');
        $allLocations = Location::orderBy('location', 'asc')->get();
    
        $startTime = new DateTime('08:00');
        $endTime = new DateTime('14:45');
        $interval = new DateInterval('PT15M');
    
        $timeIntervals = [];
    
        while ($startTime <= $endTime) {
            $formattedStartTime = $startTime->format('H:i');
            $startTime->add($interval);
            $formattedEndTime = $startTime->format('H:i');
    
            $timeIntervals[] = $formattedStartTime . ' - ' . $formattedEndTime;
        }
    
        $selectedClass = $request->input('class');
        $occupancyData = [];
    
        foreach ($allLocations as $location) {
            $locationOccupancy = [];
    
            foreach ($timeIntervals as $interval) {
                [$start, $end] = explode(' - ', $interval);
    
                $schedulesQuery = Schedule::where('date', '=', $currentdate)
                    ->where('location_id', $location->id)
                    ->where(function ($query) use ($start, $end) {
                        $query->where('time_from', '>=', $start)
                            ->where('time_from', '<', $end)
                            ->orWhere(function ($q) use ($start, $end) {
                                $q->where('time_from', '<=', $start)
                                    ->where('time_to', '>', $start);
                            });
                    })
                    ->whereDate('date', $currentdate);
    
                if ($selectedClass !== null) {
                    $schedulesQuery->where('class_id', $selectedClass);
                }
    
                $schedules = $schedulesQuery->get();
    
                if ($schedules->isNotEmpty()) {
                    $occupants = [];
                    foreach ($schedules as $schedule) {
                        $occupants[] = $schedule->user->name . ' (' . $schedule->class->class_name . ')';
                    }
                    $locationOccupancy[$interval] = ['color' => 'red', 'details' => implode(', ', $occupants)];
                } else {
                    $locationOccupancy[$interval] = ['color' => 'green', 'details' => ''];
                }
            }
    
            $occupancyData[$location->id] = $locationOccupancy;
        }
    
    
        return view('admin.main')
            ->with(compact('allLocations','locations','occupancyData', 'timeIntervals', 'currentdate', 'clas','allLocations', 'occupancyData', 'timeIntervals', 'currentdate', 'clas'));
    }     
    
      

    // public function dataOfWeek(Request $request)
    // {
    //     $clas = Grade::all()->sortBy(function ($clas) {
    //         return $clas->class_name;
    //     });
    //     $schedules = $this->getSchedules($request);
        // $currentdate =  Carbon::parse($request['userdate'])->format('Y-m-d');
        // //$day =  $currentdate->format('l');
        // $adminclass = Schedule::where('date', '=', $currentdate)
        //                       ->where('admissible', '=', 0)
        //                       ->with(['user','activity','location'])
        //                       ->orderBy('date')
        //                       ->get();
        // return view('admin.classdashboard')->with(compact('adminclass', 'currentdate'));
    //     return view('admin.weekschedule') ->with(compact('clas', 'schedules'));

    // }
    public function getSchedules(Request $request)
{
    $classId = $request->input('class');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $schedules = Schedule::with(['user', 'activity', 'location'])
        ->where('class_id', $classId)
        ->whereBetween('date', [$startDate, $endDate])

        ->orderBy('date')
        ->orderBy('time_from')
        
        ->get();
    $clas = Grade::all()->sortBy(function ($clas) {
            return $clas->class_name;
        });
        $class = Grade::find($classId);
    

        return view('admin.main', compact('locations', 'schedules', 'selectedClass', 'startDate', 'endDate','allLocations', 'occupancyData', 'timeIntervals', 'currentdate', 'clas'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.create',compact('roles'));
    }
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('admin.main')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $userID
     * @return \Illuminate\Http\Response
     */
    public function show($userID)
    {
        $user = User::find($userID);
        return view('admin.show')->with('user',$user);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->has('userdate') || empty($request['userdate'])) {
            $request['userdate'] = now()->format('Y-m-d');
        }
        
        $clas = Grade::all()->sortBy(function ($clas) {
            return $clas->class_name;
        });
    
        $currentdate = Carbon::parse($request['userdate'])->format('Y-m-d');
        $allLocations = Location::orderBy('location', 'asc')->get();
    
        $startTime = new DateTime('08:00');
        $endTime = new DateTime('14:45');
        $interval = new DateInterval('PT15M');
    
        $timeIntervals = [];
    
        while ($startTime <= $endTime) {
            $formattedStartTime = $startTime->format('H:i');
            $startTime->add($interval);
            $formattedEndTime = $startTime->format('H:i');
    
            $timeIntervals[] = $formattedStartTime . ' - ' . $formattedEndTime;
        }
    
        $selectedClass = $request->input('class');
        $occupancyData = [];
    
        foreach ($allLocations as $location) {
            $locationOccupancy = [];
    
            foreach ($timeIntervals as $interval) {
                [$start, $end] = explode(' - ', $interval);
    
                $schedulesQuery = Schedule::where('date', '=', $currentdate)
                    ->where('location_id', $location->id)
                    ->where(function ($query) use ($start, $end) {
                        $query->where('time_from', '>=', $start)
                            ->where('time_from', '<', $end)
                            ->orWhere(function ($q) use ($start, $end) {
                                $q->where('time_from', '<=', $start)
                                    ->where('time_to', '>', $start);
                            });
                    })
                    ->whereDate('date', $currentdate);
    
                if ($selectedClass !== null) {
                    $schedulesQuery->where('class_id', $selectedClass);
                }
    
                $schedules = $schedulesQuery->get();
    
                if ($schedules->isNotEmpty()) {
                    $occupants = [];
                    foreach ($schedules as $schedule) {
                        $occupants[] = $schedule->user->name . ' (' . $schedule->class->class_name . ')';
                    }
                    $locationOccupancy[$interval] = ['color' => 'red', 'details' => implode(', ', $occupants)];
                } else {
                    $locationOccupancy[$interval] = ['color' => 'green', 'details' => ''];
                }
            }
    
            $occupancyData[$location->id] = $locationOccupancy;
        }
    
        return view('admin.locationdashboard')
            ->with(compact('allLocations', 'occupancyData', 'timeIntervals', 'currentdate', 'clas'));
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userID
     * @return \Illuminate\Http\Response
     */
    public function destroy($userID)
    {
        User::find($userID)->delete();
        return redirect()->route('admin.main')
                        ->with('success','User deleted successfully');
    }
    // public function destroy($userID) {
    //     DB::delete('delete from users where id = ?',[$userID]);
    //     $user = User::find($userID);
    //     $user->delete();
    //     echo "Record deleted successfully.
    //     ";
        
    //     }
    public function dataWithLocation(Request $request)
    {
        if (!$request->has('userdate') || empty($request['userdate'])) {
            $request['userdate'] = now()->format('Y-m-d');
        }
        
        $clas = Grade::all()->sortBy(function ($clas) {
            return $clas->class_name;
        });
    
        $currentdate = Carbon::parse($request['userdate'])->format('Y-m-d');
        $allLocations = Location::orderBy('location', 'asc')->get();
    
        $startTime = new DateTime('08:00');
        $endTime = new DateTime('14:45');
        $interval = new DateInterval('PT15M');
    
        $timeIntervals = [];
    
        while ($startTime <= $endTime) {
            $formattedStartTime = $startTime->format('H:i');
            $startTime->add($interval);
            $formattedEndTime = $startTime->format('H:i');
    
            $timeIntervals[] = $formattedStartTime . ' - ' . $formattedEndTime;
        }
    
        $selectedClass = $request->input('class');
        $occupancyData = [];
    
        foreach ($allLocations as $location) {
            $locationOccupancy = [];
    
            foreach ($timeIntervals as $interval) {
                [$start, $end] = explode(' - ', $interval);
    
                $schedulesQuery = Schedule::where('date', '=', $currentdate)
                    ->where('location_id', $location->id)
                    ->where(function ($query) use ($start, $end) {
                        $query->where('time_from', '>=', $start)
                            ->where('time_from', '<', $end)
                            ->orWhere(function ($q) use ($start, $end) {
                                $q->where('time_from', '<=', $start)
                                    ->where('time_to', '>', $start);
                            });
                    })
                    ->whereDate('date', $currentdate);
    
                if ($selectedClass !== null) {
                    $schedulesQuery->where('class_id', $selectedClass);
                }
    
                $schedules = $schedulesQuery->get();
    
                if ($schedules->isNotEmpty()) {
                    $occupants = [];
                    foreach ($schedules as $schedule) {
                        $occupants[] = $schedule->user->name . ' (' . $schedule->class->class_name . ')';
                    }
                    $locationOccupancy[$interval] = ['color' => 'red', 'details' => implode(', ', $occupants)];
                } else {
                    $locationOccupancy[$interval] = ['color' => 'green', 'details' => ''];
                }
            }
    
            $occupancyData[$location->id] = $locationOccupancy;
        }
    
        return view('admin.min')
            ->with(compact('allLocations', 'occupancyData', 'timeIntervals', 'currentdate', 'clas'));
    }
    public function otherFunctionality(Request $request)
{
    $locations = Location::orderBy('location', 'asc')->get();
    $locationId = $request->input('location');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Fetch all dates between the start and end date selected by the user
    $selectedDates = [];
    $currentDate = $startDate;

    while ($currentDate <= $endDate) {
        $selectedDates[] = $currentDate;
        $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
    }

    // Fetch all time intervals within the day (from 08:00 to 15:00)
    $startTime = new DateTime('08:00');
    $endTime = new DateTime('14:45');
    $interval = new DateInterval('PT15M');

    $timeIntervals = [];
    $currentTime = clone $startTime;

    while ($currentTime <= $endTime) {
        $formattedStartTime = $currentTime->format('H:i');
        $currentTime->add($interval);
        $formattedEndTime = $currentTime->format('H:i');
        $timeIntervals[] = $formattedStartTime . ' - ' . $formattedEndTime;
    }

    // Logic to fetch booked/free intervals for each date and interval
    $occupancyData = [];

    foreach ($selectedDates as $date) {
        $occupancyData[$date] = [];

        foreach ($timeIntervals as $interval) {
            [$startTime, $endTime] = explode(' - ', $interval);

            // Retrieve schedule data for this interval and date
            $scheduleDetails = Schedule::where('location_id', $locationId)
                ->where('date', $date)
                ->where('time_from', '<', $endTime)
                ->where('time_to', '>', $startTime)
                ->get();

            // Set the color based on booked/free status
            if ($scheduleDetails->isNotEmpty()) {
                // If booked, set color to red and populate tooltip details
                $tooltipDetails = '';

                foreach ($scheduleDetails as $schedule) {
                    // Customize this based on your Schedule model's attributes
                    $tooltipDetails .= $schedule->user->name . ' (' . $schedule->class->class_name .' , '. $schedule->remarks.  ')' ;
                }

                $occupancyData[$date][$interval]['color'] = 'red';
                $occupancyData[$date][$interval]['details'] = $tooltipDetails;
            } else {
                // If free, set color to green
                $occupancyData[$date][$interval]['color'] = 'green';
            }
        }
    }

    // Pass data to the view
    return view('admin.main', [
        'selectedDates' => $selectedDates,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'timeIntervals' => $timeIntervals,
        'occupancyData' => $occupancyData,
        'locations' => $locations
        // Other data you might need in your view
    ]);
}

    
}
    

