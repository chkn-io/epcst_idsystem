<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teachers;
use App\Models\Logs;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stmt = Teachers::where('status','!=','deactivated')
                            ->orderBy('last_name','ASC')
                            ->get();

        return view('reports', [
            "active"=>'reports',
            'records'=>$stmt
        ]);
    }

    public function generateReport(Request $request){
        
        $ids = [];
        foreach(json_decode($request->list) as $list){
            $ids[] = $list->id;
        }
        $from = date($request->from.' 00:00:00');
        $to = date($request->to.' 23:59:59');
        if($ids[0] == 0){
            $stmt = Teachers::where('status','=','active')
                            ->orderBy('last_name','ASC')
                            ->get();
        }else{
            $stmt = Teachers::find($ids);
        }
        $logs = Logs::whereBetween('created_at',[$from,$to])->get();
        $output = [];
        $x = 0;
        foreach($stmt as $employee){
            $output[$x]['employee'] = $employee->last_name.', '.$employee->first_name.' '.$employee->middle_name;
            $timein = [];
            $timeout = [];
            foreach($logs as $log){
                if($log->teachers_id == $employee->id){
                    if($log->type == 'in'){
                        $timein[date('m/d',strtotime($log->created_at))][] = date('h:i A',strtotime($log->created_at));
                    }
                    if($log->type == 'out'){
                        $timeout[date('m/d',strtotime($log->created_at))][] = date('h:i A',strtotime($log->created_at));
                    }
                }
            }
            $output[$x]['in'] = $timein;
            $output[$x]['out'] = $timeout;
            $x++;
        }

        return response($output);
    }
}
