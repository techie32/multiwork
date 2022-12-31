<?php

namespace App\Http\Controllers;
use App\Models\Time_available;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeAvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        dd($request);
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



        // $days = $request->day_select;



        // $start = Carbon::parse($request->start_time)->format('H:i');
        // $end = Carbon::parse($request->end_time)->format('H:i');



        // $s_time =  Format("G-i", strtotime($request->start_time));
        // $s_time =Carbon::parse($request->start_time)->format('H:i');
        // $e_time = date("Y-m-d", strtotime($request->end_time));
        // $e_time =Carbon::parse($request->end_time)->format('H:i');
 

        $documents = [];
        
        // foreach ($days as $key =>$value){
        //     dd( $key);
        //     $document = new time_available(array(
        //         'day_name'=> $request->day_select_[$key],
        //         'start_time' => Carbon::parse($request->start_time_[$key])->format('H:i'),
        //         'end_time' => Carbon::parse($request->end_time_[$key])->format('H:i'),
        //     ));
      
        //     // $document->save();
        //     $documents[] = $document;
        // }

       
        // return view('Admin.timing_available',compact('time'));
    
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

        $data = time_available::select('start_time')->get()->first();
      dd($data);
        $test = Carbon::createFromFormat('H:s',$data);
        dd($test);
        // $t = Carbon::parse($data)->format('H:i');
        // dd($t);
        // dd($data);
        foreach($data as $key => $value)
        {
            // $explode_id = json_encode($data, true);
            // dd($value);
          
            $to = Carbon::createFromFormat('H:s', $value);
            dd($to);
            $from = Carbon::createFromFormat('H:s',$value);
            $diff_in_hours = $to->diffInHours($from);
            dd($diff_in_hours);
        }
       
    }

   
}
