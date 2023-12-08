<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\User;
use App\Models\Schedule;
use DateInterval;
use DatePeriod;
use DateTime;
use App\Models\Activity;
use DB;
use App\Models\Location;
use Carbon\Carbon;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activities = Activity::all()->sortBy(function ($activities) {
            return $activities->activity_name;
        }); 
        $locations = Location::all()->sortBy(function ($locations) {
            return $locations->location;
        });
        $clas = Grade::all()->sortBy(function ($clas) {
            return $clas->class_name;
        });
        $persons = User::all()->sortBy(function ($person) {
            return $person->name;
        });
        // $supervisor = Auth::user()->
        return view('home')->with('activities', $activities)
            ->with('locations', $locations)
            ->with('clas', $clas)
            ->with('persons', $persons);
    }
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'persons' => 'required|array',
                'persons.*' => 'integer',
                'day' => 'required|array',
                'activity' => 'required|integer',
                'location' => 'required|integer',
                'remarks' => 'string|nullable',
            ]);
    
            // Check if start and end times are within allowed hours (8 AM to 3 PM)
            $startTime = Carbon::createFromFormat('H:i', $request->start_time);
            $endTime = Carbon::createFromFormat('H:i', $request->end_time);
    
            if (
                $startTime->lessThan(Carbon::createFromTime(8, 0)) ||
                $endTime->greaterThan(Carbon::createFromTime(15, 0))
            ) {
                return redirect()->back()->with('error', 'Schedule time should be between 8 AM and 3 PM.');
            }
    
            $begin = new DateTime($request->start_date);
            $end = new DateTime($request->end_date);
            $end->setTime(0, 0, 1);
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
    
            // Check if the location is already booked for the specified time frame
            $locationId = $request->location;
            $selectedDays = $request->day;
    
            $existingSchedules = Schedule::where('location_id', $locationId)
                ->whereIn('day', $selectedDays)
                ->get();
    
            foreach ($existingSchedules as $existingSchedule) {
                if (
                    ($startTime >= $existingSchedule->time_from && $startTime < $existingSchedule->time_to) ||
                    ($endTime > $existingSchedule->time_from && $endTime <= $existingSchedule->time_to) ||
                    ($startTime <= $existingSchedule->time_from && $endTime >= $existingSchedule->time_to)
                ) {
                    return redirect()->back()->with('error', 'Location is already booked for ' . $existingSchedule->user->name . ' at this date and time.');
                }
            }
    
            // Loop through each selected person
            foreach ($request->input('persons') as $selectedPersonId) {
                foreach ($period as $dt) {
                    if (in_array($dt->format('l'), $request->day)) {
                        $startDate = Carbon::parse($dt);
    
                        // Create a new schedule for the current person
                        $data = new Schedule();
                        $data->date = $startDate;
                        $data->time_from = $startTime->format('H:i');
                        $data->time_to = $endTime->format('H:i');
                        $data->day = $dt->format('l');
                        $data->user_id = $selectedPersonId;
                        $data->department = Auth::user()->dep_id;
                        $data->class_id = $request->class;
                        $data->activity_id = $request->activity;
                        $data->location_id = $locationId;
                        $data->remarks = $request->remarks;
                        $data->save();
                    }
                }
            }
    
            return redirect()->back()->with('success', 'Schedule added Successfully');
        } catch (\Exception $e) {
            // Catch any exception (including SQL errors) and redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
        // public function checkLocationAvailability(Request $request)
        // {
        //     $locationId = $request->input('location_id');
        //     $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
        //     $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
        //     $startTime = Carbon::createFromFormat('H:i:s', $request->input('start_time'));
        //     $endTime = Carbon::createFromFormat('H:i:s', $request->input('end_time'));

        //     $isLocationAvailable = Schedule::where('location_id', $locationId)
        //     ->where(function($query) use ($startDate, $endDate, $startTime, $endTime) {
        //         $query->whereBetween('date', [$startDate, $endDate]);
        //             })
        //             ->orWhere(function($query) use ($startTime, $endTime) {
        //                 $query->whereTime('time_from', '<', $endTime)
        //                     ->whereTime('time_to', '>', $startTime);
                    
        //     })->get();// query database to check if the location is available during the specified time frame
        
        //     if ($isLocationAvailable) {
        //         return response()->json(['success' => 'Location is available']);
        //     } else {
        //         return response()->json(['error' => 'Location is already booked']);
        //     }
        // }

    

        // public function checkSchedule(Request $request)
        // {
        //   $location = $request->input('location');
        //   $timeFrom = $request->input('timeFrom');
        //   $timeTo = $request->input('timeTo');
        
        //   $scheduleCount = Schedule::where('location', $location)
        //                             ->where('time_from', $timeFrom)
        //                             ->where('time_to', $timeTo)
        //                             ->count();
        
        //   if ($scheduleCount > 0) {
        //     return response()->json(['available' => false]);
        //   } else {
        //     return response()->json(['available' => true]);
        //   }
        // }
        
    // public function check(Request $request)
    // {
    //     $selectedValue = $request->location_id;
    //     $dateFrom = $request->dateFrom;
    //     $dateTo = $request->dateTo;
    //     $timeFrom= $request->timeFrom;
    //     $timeTo= $request->timeTo;
    //     $existingrecod = DB::table('Schedule')
    //                              ->where('location_id',[$selectedValue])
    //                              ->whereBetween('date', [$dateFrom, $dateTo])
    //                              ->where('time_from',[$timeFrom])
    //                              ->where('time_to',[$timeTo])
    //                              ->get();
    //     return response()->json(['success' => true]);
    
    // }
    
    

    public function displayActivity(Request $request)
    {
        $data =  Schedule::where('id', '>=', 1)->with(['person'])->get()->toArray();
        echo "<pre>";
        print_r($data);

    }

}