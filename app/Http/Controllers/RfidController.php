<?php

namespace App\Http\Controllers;


use App\Models\Teachers;
use App\Models\Logs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RfidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('rfid');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $img = str_replace('data:image/png;base64,', '', $request->snapshot);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = 'snapshots/'.date("YmdHis").'.png';

        $stmt = Teachers::where('rfid',$request->rfid_code)->get();

        if(!$stmt->isEmpty()){
            $logs = Logs::where('teachers_id',$stmt[0]->id)
                        ->where('created_at','LIKE','%'.date('Y-m-d').'%')
                        ->orderBy('id', 'DESC')
                        ->limit(1)
                        ->get();

            if(count($logs) == 0){
                $type = 'in';
            }else{
                $type = $logs[0]->type == 'in' ? 'out' : 'in';
            }

            $employee = Logs::create([
                'teachers_id'=>$stmt[0]->id,
                'type'=>$type,
                'snapshot'=>$file,
                'user_id'=>Auth::user()->id
            ]);
            
            $time = date('h:i A',strtotime($employee->created_at));
            Storage::disk('public')->put($file,  $data);

            return response([
                'time'=>$time,
                'type'=>$type == 'in' ? 'TIME IN':'TIME OUT',
                'employee_number'=>$stmt[0]->employee_number,
                'name'=>$stmt[0]->last_name.', '.$stmt[0]->first_name.' '.$stmt[0]->middle_name,
                'picture'=>$stmt[0]->picture
            ],200)
            ->header('Content-Type', 'application/json');
        }else{
            return response(['message'=>'No Record Found'],404)
            ->header('Content-Type', 'application/json');
        }


        
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
        //
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
        //
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
