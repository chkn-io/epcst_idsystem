<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DailyTimeRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teachers::orderBy('last_name', 'ASC')->get();
        return view('dailytimerecord', [
            "active"=>'dtr',
            'employees'=>$teachers
        ]);
    }

    public function employee(Request $request){
        $employee = Teachers::find($request->employee);
        if($employee){
           $logs = $employee->logs()->whereBetween('created_at', [$request->from, $request->to])
            ->get();

            $dtr_logs = [];


            $startDate = Carbon::createFromFormat('m/d/Y', date('m/d/Y',strtotime($request->from)));
            $endDate = Carbon::createFromFormat('m/d/Y', date('m/d/Y',strtotime(datetime: $request->to)));
            
            // Get all dates between start and end date
            $dates = [];
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $dates[] = $date->format('m/d/Y'); // Format the date as needed
            }

            foreach($dates as $date){
                $dtr_logs[$date]['in'] = [];
                $dtr_logs[$date]['out'] = [];
                foreach($logs as $log){
                    if(date('m/d/Y',strtotime($log->created_at)) == $date){
                        if($log->type == 'in'){
                            $dtr_logs[$date]['in'][$log->id] = ['time'=>date('H:i:s',strtotime($log->created_at->toDateTimeString())),'snapshot'=>$log->snapshot];
                        }
                        if($log->type == 'out'){
                            $dtr_logs[$date]['out'][$log->id] = ['time'=>date('H:i:s',strtotime($log->created_at->toDateTimeString())),'snapshot'=>$log->snapshot];
                        }

                    }
                }
            }


            return response()->json(['success' => true, 'data' => $dtr_logs]);
        }
    }

    public function save_dtr(Request $request){
        if($request->new_timeentries != ''){
            foreach($request->new_timeentries as $time_entry){
                $dateTimeString = date('Y-m-d',strtotime($time_entry['date'])) . ' ' . $time_entry['time'];
    
                $createdAt = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);
                
        
                $log = new Logs();
                $log->teachers_id = $time_entry['teachers_id'];
                $log->type = $time_entry['type'];
                $log->snapshot = $time_entry['snapshot'];
                $log->created_at = $createdAt;
                $log->user_id = auth()->id();
    
                $log->save();
            }
        }

        if (!empty($request->old_timeentries)) {
            // Start a transaction
            DB::transaction(function () use ($request) {
                foreach ($request->old_timeentries as $time_entry) {
                    // Ensure date and time are present
                    if (isset($time_entry['date'], $time_entry['time'])) {
                        // Prepare the datetime string
                        $dateTimeString = date('Y-m-d H:i', strtotime($time_entry['date'] . ' ' . $time_entry['time']));
                        $createdAt = Carbon::createFromFormat('Y-m-d H:i', $dateTimeString);
    
                        // Find and update the log
                        Logs::where('id', $time_entry['id'])
                            ->update(['created_at' => $createdAt]);
                    }
                }
            });
        }
    
        return response()->json(['success' => true]);

       
    }
}
