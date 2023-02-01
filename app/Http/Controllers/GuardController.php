<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GuardController extends Controller
{
    //
    public function index(Request $request){
        $guard = User::where('email','=',$request->rfid)->get();
        // dd($guard);
        if(!$guard->isEmpty()){
            Auth::loginUsingId($guard[0]['id']);
            return redirect()->route('home');
        }else{
            return Redirect::back()->withErrors(['msg' => 'Invalid RFID Number']);
        }
    }
}
