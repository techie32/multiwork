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
    public function update(Request $request)
    {
        $day  = $request->id;

        $day_s = $request->day_select;
        
        $stime = $request->start_time;
        
        $etime = $request->end_time;
        
      
        $s_value = array_values(array_filter($stime));
        
        $e_value = array_values(array_filter($etime));
       
        foreach($day as $key =>$value){
    
            $check = $request->input($key);
     

            if($check == '1'){
                   $check = 1;
            }
            else{
                $check = 0;
            };
                  
            $timing = time_available::where('id', '=' , $value)
            ->update(['start_time' =>$s_value[$key],'end_time' => $e_value[$key],'active' => $check]);
            
        }
        return Redirect()->route('timing-availability');
       

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

    public function cal($dayname){
      
    
        $s = time_available::select('start_time')->first();
        $e = time_available::select('end_time')->first();
      
  
            $att = DB::table('time_available')
                    ->select('*')
                    ->where('day_name','=', $dayname)
                    ->get();
            
            $period = new CarbonPeriod($att[0]->start_time, '1 hour', $att[0]->end_time); // for create use 24 hours format later change format 
            $slots = [];
            foreach($period as $item){
                array_push($slots,$item->format("h:i A"));
            }

            return $slots;  
        
       
    }
    public function TimeShow(){
        $timing = time_available::all();
        return view('Admin.time_sch',compact('timing'));
    }

   
}
