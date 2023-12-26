<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; // Add this at the top if not already imported
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Schedule;
use App\Models\Location;
use App\Models\Grade;
use App\Models\Activity;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateInterval;

class AdmindashboardController extends Controller
{
    // public function admindata()
    // {
    //     $today = Today()->toDateString();
    //     $admindata = Schedule::where('date', '=', $today)
    //                         ->with(['person','activity','location'])
    //                         ->orderBy('date')
    //                         ->get();
    //     // $activitydata = Schedule::where('id', '>=', 1)->with(['activity'])->get();
    //     // return view('admindashboard');
    //     return view('admindashboard')->with(compact('admindata'));
    // }
    // public function admindata() {
    //     return view('admindashboard');
    // }
    public function dataWithdate(Request $request)
    {
        $currentdate =  Carbon::parse($request['userdate'])->format('Y-m-d');
        //$day =  $currentdate->format('l');
        $admindata = Schedule::where('date', '=', $currentdate)
                              ->where('admissible', '=', 0)
                              ->with(['user','activity','location'])
                              ->orderBy('date')
                              ->get();
        return view('admin.admindashboard')->with(compact('admindata', 'currentdate'));
    }
     
    public function dataWithclass(Request $request)
    {
        
        $currentdate =  Carbon::parse($request['userdate'])->format('Y-m-d');
        //$day =  $currentdate->format('l');
        $adminclass = Schedule::where('date', '=', $currentdate)
                              ->where('admissible', '=', 0)
                              ->with(['user','activity','location'])
                              ->orderBy('date')
                              ->get();
        return view('admin.classdashboard')->with(compact('adminclass', 'currentdate'));
    }
    

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
    
        return view('admin.locationdashboard')
            ->with(compact('allLocations', 'occupancyData', 'timeIntervals', 'currentdate', 'clas'));
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
    

        return view('admin.weekschedule') ->with(compact('clas', 'schedules','class', 'startDate', 'endDate'));
}
public function index()
{
    $schedules = Schedule::with(['user', 'location'])->get();
    $users = User::all();
    $locations = Location::all();

    return view('admin.user_edit_view', compact('schedules', 'users', 'locations'));
}

public function show($id)
{
    $schedule = Schedule::with(['user', 'location'])->find($id);
    $users = User::all();
    $locations = Location::all();
    $departments = Department::all(); 
    $activities = Activity::all(); 
    $grades = Grade::all();
    return view('admin.user_edit_view', compact('schedule', 'users', 'locations','departments','activities','grades'));
}
public function edit(Request $request, $id)
{
    // Retrieve all form fields from the request
    $location_id = $request->input('location_id');
    $class_id = $request->input('class_id');
    $user_id = $request->input('user_id');
    $time_from = $request->input('time_from');
    $time_to = $request->input('time_to');
    $remarks = $request->input('remarks');
    $department_id = $request->input('department');
    $activity_id = $request->input('activity_id');
    $day = $request->input('day'); // If present in the form
    $date = $request->input('date'); // If present in the form

    // Check if location_id and user_id are set
    if ($location_id === null || $user_id === null) {
        return back()->with('error', 'Location or User not selected');
    }

    // Find the schedule by ID
    $schedule = Schedule::find($id);

    if (!$schedule) {
        return back()->with('error', 'Schedule not found');
    }

    // Find the user by userID
    $user = User::find($user_id);

    // Check if the user is found
    if (!$user) {
        return back()->with('error', 'User not found');
    }

    // Update the schedule's fields
    $schedule->update([
        'location_id' => $location_id,
        'class_id' => $class_id,
        'user_id' => $user->userID,
        'time_from' => $time_from,
        'time_to' => $time_to,
        'remarks' => $remarks,
       'department' => $department_id,
        'activity_id' => $activity_id,
        'day' => $day, // If present in the form
        'date' => $date, // If present in the form
        // Add other fields as needed
    ]);

    // Reload the updated schedule with the associated user
    $updatedSchedule = Schedule::with('user')->find($id);

    // Check if the update was successful
    if ($updatedSchedule) {
        return back()->with('success', 'Record Updated Successfully')->with('timestamp', now())->with('updatedSchedule', $updatedSchedule);
    } else {
        return back()->with('error', 'Error updating record');
    }
}

}