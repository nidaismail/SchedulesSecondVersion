<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class UserDeleteController extends Controller
{
    public function index(){
        $users = DB::select('select * from schedule');
        return view('user_delete_view',['users'=>$users]);
        }
       
            public function destroy($id) {
                DB::delete('delete from schedule where id = ?', [$id]);
            
                return back()->with('success', 'Record Deleted Successfully');
            }
}

