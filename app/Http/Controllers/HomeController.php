<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
         $stmt = DB::select('
         SELECT 
         CONCAT(t.last_name,", ",t.first_name) as name,
         IFNULL((SELECT type FROM logs as l WHERE t.id = l.teachers_id and created_at LIKE "%'.date('Y-m-d').'%" ORDER BY l.id DESC LIMIT 1 ),"out") as status
         FROM teachers as t
         
         ORDER BY status ASC;
        ');

        return view('home', [
            "active"=>'home',
            'status'=>$stmt
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

}
