<?php

namespace App\Http\Controllers;
use App\Models\Time_available;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Carbon\CarbonPeriod;
class TimeAvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.time_sch');
        // return Redirect()->route('timing-availability');
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
    
        // $s_time = Carbon::parse($request->start_time)->format('H:i');
        // $e_time = Carbon::parse($request->end_time)->format('H:i');
        // dd($request,$s_time,$e_time);
    
        // dd($days);
        // $now = date('Y-m-d H:i');
        // $now = $request->timing_select;

        // $timing = $request->start_time;
        // dd($timing);
    
        // dd(gettype($timing));
        // $s_time =Carbon::parse($request->start_time)->format('G-i');
    
        // $e_time=Carbon::parse($request->end_time)->format('yy-m-d');
        // dd($s_time,$e_time);
        // $serializedArr = serialize($days);
        // dd()
        // $serializedArr->save();
        // dd($serializedArr);
        // foreach($days as $key=>$row){
        //     $data=([
        //         'week_name' => $days[$key],
        //         'week_name' => $days[$key]
        //     ]);
        //     dd($data);
        // }
        // $serializedArr = serialize($days);
        // $serializedArr = new time_available();
        // $serializedArr->save();
        // $data;



      
        // $stime[] = $request->start_time;
        // dd($stime);
        // dd($days,$stime);
        // $start = Carbon::parse($request->start_time)->format('H:i');
        // $end = Carbon::parse($request->end_time)->format('H:i');

        // $starttime = Carbon::parse($request->start_time);
        // $endtime = Carbon::parse($request->end_time);

        // $s_time =  Format("G-i", strtotime($request->start_time));
        // $s_time =Carbon::parse($request->start_time)->format('H:i');
        // $e_time = date("Y-m-d", strtotime($request->end_time));
        // $e_time =Carbon::parse($request->end_time)->format('H:i');

        // $
        
       
        // $collection = collect([$request->start_time]);
        // // dd($collection);
        // // dd($collection);\
        // $value = $request->start_time;
        // foreach($value as $key){
        //     $collection->filter(function($value, $key) {
        //         return  $value != null;
        //     });
        // };
        // dd($collection);
        // $stime = 
        
        // $end_time = $request->end_time;
        // foreach($request as $key =>$value){
        //     $document = new time_available(array(
        //         'day_name'=> $request->day_select,
        //         'start_time' => $request->start_time,
        //         'end_time' => $request->end_time
        //     ));
            
        //     dd($document);
        //     $document->save();
            
        //     $documents[] = $document;
        // }
        $days = $request->day_select;
        $s_time = $request->start_time;
        $e_time = $request->end_time;
        $s_value = array_values(array_filter($s_time));
        $e_value = array_values(array_filter($e_time));
        
        $documents = [];
        
        foreach($days as $key =>$value){
            $document = new time_available(array(
                'day_name'=> $request->day_select[$key],
                'start_time' => $s_value[$key],
                'end_time' => $e_value[$key]
            ));
            
            $document->save();
            $documents[] = $document;
        }
        // dd($document);

       
        // return view('Admin.time_sch');
    
        return Redirect()->route('timing-availability');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

    public function cal(){
        // $to = Carbon::createFromFormat('H:s', '9:30');
        // $from = Carbon::createFromFormat('H:s', '11:30');
        // $diff_in_hours = $to->diffInHours($from);
        // dd($diff_in_hours);

        $s = time_available::select('start_time')->first();
        $e = time_available::select('end_time')->first();
        $s= "Monday";

        $att = DB::table('time_available')
                ->select('*')
                ->where('day_name','=', 'Monday')
                ->get();
        // dd($att[0]->start_time,);
        // dd();
        $period = new CarbonPeriod($att[0]->start_time, '1 hour', $att[0]->end_time); // for create use 24 hours format later change format 
        $slots = [];
        foreach($period as $item){
            array_push($slots,$item->format("h:i A"));
        }

        return $slots;  
        dd($slots);    

        // $test1 = Carbon::createFromFormat('H:s',$e);
        // $test2 = Carbon::createFromFormat('H:s',$e);
        // dd($test1,$test2);

        // $t = Carbon::parse($data)->format('H:i');
        // dd($t);
        // dd($data);
        foreach($data as $key => $value)
        {
            $to = Carbon::createFromFormat('H:s', $value);
            dd($to);
            $from = Carbon::createFromFormat('H:s',$value);
            $diff_in_hours = $to->diffInHours($from);
            dd($diff_in_hours);
        }
       
    }
    public function TimeShow(){
        $timing = time_available::all();
        return view('Admin.time_sch',compact('timing'));
    }

   
}
