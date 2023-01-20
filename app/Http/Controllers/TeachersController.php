<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $stmt = Teachers::all();
        return view('employees', [
            "active"=>'employees',
            'employees'=>$stmt
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'employee_number' => 'required|unique:teachers|max:6',
            'first_name'=>'required',
            'middle_name'=>'nullable',
            'last_name'=>'required',
            'rfid' => 'nullable|unique:teachers',
            'picture'=>'required|mimes:png,jpg,jpeg'
        ]);

        $extension = pathinfo($request->file('picture')->getClientOriginalName(), PATHINFO_EXTENSION);
        $filename = time().'.'.$extension;
        
        $path = $request->file('picture')->storeAs(
            'images', $filename         
        );
        
        $validated['picture'] = $path;
        $employee = Teachers::create($validated);

        $request->old('employee_number');
        $request->old('first_name');
        $request->old('middle_name');
        $request->old('last_name');
        $request->old('rfid');
        
        return redirect('/employees');
    }

    public function status($status,$id){
        $stmt = Teachers::where('id',$id)->exists();
        if($stmt){
            $employee = Teachers::find($id);
            $employee->status = $status;
            $employee->save();   
            return redirect('/employees');      
        }else{
            return abort(404);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $stmt = Teachers::where('id',$id)->get();

        if(!$stmt->isEmpty()){
            return view('employeeupdate', [
                "active"=>'employees',
                "employee"=>$stmt
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
        
        $stmt = Teachers::where('id',$id)->exists();

        if($stmt){
            $stmt = Teachers::where('id',$id)->get();
            $en = $stmt[0]->employee_number != $request->employee_number ? '|unique:teachers':'|';
            $rfid = $stmt[0]->rfid != $request->rfid ? '|unique:teachers':'|';
            $validated = $request->validate([
                'employee_number' => 'required'.$en.'|max:6',
                'first_name'=>'required',
                'middle_name'=>'nullable',
                'last_name'=>'required',
                'rfid' => 'nullable'.$rfid,
                'picture'=>'nullable|mimes:png,jpg,jpeg'
            ]);

            if(isset($request->picture)){
                $filename = $stmt[0]->picture;
                $path = $request->file('picture')->storeAs(
                    'images', str_replace('images/','',$filename)         
                );
                $validated['picture'] = $filename;
            }
           
            Teachers::where('id', $id)
                ->update($validated);
            
            return redirect('/employees');
        }
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
}
