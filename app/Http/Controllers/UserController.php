<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return view('users', ["active"=>'users'],["users"=> $users] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $users = User::where('id',$id)->get();

        if(!$users->isEmpty()){
            return view('resetpassword', [
                "active"=>'users',
                "user"=>$users
            ]);
        }else{
            return abort(404);
        }

        // return view('resetpassword');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $users = User::where('id',$id)->get();

        if(!$users->isEmpty()){
            return view('users_update', [
                "active"=>'users',
                "user"=>$users
            ]);
        }else{
            return abort(404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $request->validate([
            'name' => 'required',
            'email' => 'required',
            ]);

            $users = User::find($id);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->update();
            return redirect('users');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function reset(Request $request,$id){
        $users = User::find($id);

        $request->validate([
            'password' => 'required|min:8|confirmed',
            ]);

        $users->password = Hash::make($request->password);
        $users->update();

        
        return back()->with("status", "Reset password successfully!");
        
    }
}
