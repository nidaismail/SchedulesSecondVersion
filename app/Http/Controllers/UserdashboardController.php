<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Models\Grade;
// namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Schedule;

class UserdashboardController extends Controller
{
    public function preview()
    {
        $today = Today()->toDateString();
        $user_role = Auth::user()->getRoleNames();
        $classes = Grade::all();
        foreach ($user_role as $role) {
            if ($role == 'admin') {
              
                $persondata = Schedule::where('date', '>=', $today)
                                            ->with(['user','activity','location'])
                                            ->orderBy('date')
                                            ->get();       
                                            $classes = Grade::all();                 
                    return view('userdashboard')->with(compact('persondata','classes'));
                
            } elseif ($role == 'supervisor') {
                    $persondata = Schedule::where('department', '=', Auth::user()->dep_id)
                                            ->where('date', '>=', $today)
                                            ->with(['user','activity','location'])
                                            ->orderBy('date')
                                            ->get();     
                                            $classes = Grade::all();                     
                    return view('userdashboard')->with(compact('persondata','classes'));
            } else {
                
                $persondata = Schedule::where('user_id', '=', Auth::user()->userID)
                                        ->where('date', '>=', $today)
                                        ->with(['user','activity','location'])
                                        ->orderBy('date')
                                        ->get();    
                                        $classes = Grade::all();                
                return view('userdashboard')->with(compact('persondata','classes'));
            }
        }
    }

    public function classview(){
        $today = Today()->toDateString();
        $schedules = Schedule::where('date', '>=', $today)
                                            ->with(['user','activity','location'])
                                            ->orderBy('date')
                                            ->get();      
                                            $classes = Grade::all();               
                    return view('classview')->with(compact('schedules','classes'));
        }
    
       
    
    public function admissible(Request $request)
    {
        $data = Schedule::whereIn('id', $request['schedule_id'])->update(['admissible'=>1]);
        $data = Schedule::whereNotIn('id', $request['schedule_id'])->update(['admissible'=>0]);

        // $data->admissible = $request['schedule_id'];
    }
   
  
    public function index(){
        $users = DB::select('select * from schedule');
        return view('user_delete_view',['users'=>$users]);
        }
        public function destroy($id) {
        DB::delete('delete from schedule where id = ?',[$id]);
        
        return back()
        ->with('success','Record Deleted Successfully')
        ->with('file');
        return redirect()->route('/view');
        }
}



