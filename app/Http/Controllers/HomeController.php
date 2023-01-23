<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Logs;

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

        $date = Session::has('dashboard_date') ? session('dashboard_date') : date('Y-m-d');

        echo $date;
       
         $stmt = DB::select('
         SELECT 
         CONCAT(t.last_name,", ",t.first_name) as name,
         IFNULL((SELECT type FROM logs as l WHERE t.id = l.teachers_id and created_at LIKE "%'.$date.'%" ORDER BY l.id DESC LIMIT 1 ),"out") as status
         FROM teachers as t
         
         ORDER BY status ASC;
        ');

        $logs = Logs::select('logs.created_at','logs.type','logs.snapshot','teachers.last_name','teachers.first_name','teachers.middle_name')
                        ->join('teachers','teachers.id','=','logs.teachers_id')
                        ->where('logs.created_at','LIKE','%'.$date.'%')
                        ->orderBy('logs.created_at','ASC')
                        ->get();
        session()->forget('dashboard_date');
        return view('home', [
            "active"=>'home',
            'status'=>$stmt,
            'logs'=>$logs,
            'date'=>date('F d, Y',strtotime($date))
        ]);
    }

    public function showChangePasswordGet() {
        return view('auth.passwords.change-password', ['active'=>'home']);
    }
    
    public function changePasswordPost(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");
    }

    public function updateDate(Request $request){
        session(['dashboard_date' => $request->date]);
        return response(["message"=>"Date updated"],200)
            ->header('Content-Type', 'application/json');
    }

}
