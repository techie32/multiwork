<?php

namespace App\Http\Controllers;
use App\Models\Time_available;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Carbon\CarbonPeriod;
use DateTime;
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

    public function cal($givendate){

        $weekDays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        $dateValue= "2023/01/01";
        $day = date('l', strtotime($dateValue));
      
        $availableDays = DB::table('time_available')
                ->select('*')
                ->where('active','=',1)
                ->get();

        $daysInAvailableDays = [];
        foreach($availableDays as $key => $value){
            $daysInAvailableDays[] = $value->day_name;
        }
        $l = $givendate;
        $leadtime = '1 hour';
        $date =  new Carbon($l);

        $daysWithSlots = [];
        while (count($daysWithSlots) < 7) {
            $date->modify('+1 day');
          
            if (in_array($weekDays[$date->format('w')], $daysInAvailableDays)) {

                $specificDay = '';
                foreach($availableDays as $key => $value){
                    if($value->day_name == $weekDays[$date->format('w')] ){
                        $specificDay = $value;
                    }
                }
                    $period = new CarbonPeriod($specificDay->start_time, $leadtime, $specificDay->end_time); 
                    $slots = [];
                    foreach($period as $item){
                        array_push($slots,$item->format("h:i A"));
                    } 

                $daysWithSlots[] = [
                  'date' => $date->format('j'),
                  'slots' => $slots,
                  'dayName' => $weekDays[$date->format('w')],
                ];
            }
        }
        // dd($daysWithSlots);
        return $daysWithSlots;
       
    }
    public function TimeShow(){
        $timing = time_available::all();
        return view('Admin.time_sch',compact('timing'));
    }

    public function dayslot(){
        
        // $weekDays = ["sun", "mon", "tues", "wed", "thurs", "fri", "sat"];      
        // // $availableDays = ["mon", "tues", "fri", "sun"];
        // $availableDays = ["mon", "tues", "fri", "sun"];
        // $slots = ["01:00", "10:00"];

        // $date = Carbon::now();
        // $daysWithSlots = [];

        // while (count($daysWithSlots) < 8) {
        //     // dd('he');
        //   $date = new Carbon($date.carbon::setDate($date.getDate() + 1));
        //   if ($availableDays.includes($weekDays[$date.getDay()])) {
        //     $daysWithSlots.push(
            
        //         // date: date.getDate(),
        //       $slots,
        //       dayName: $weekDays[date.getDay()],
        //     );
        //   }
        // }
        // dd($daysWithSlots)  ;

        // 7 days fetch 
        // $date = date('Y-m-d'); //today date
        // $weekOfdays = array();
        // for($i =1; $i <= 7; $i++){
        //   $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
        //   $weekOfdays[] = date('l : Y-m-d', strtotime($date));
        // }
        // // print_r($weekOfdays);
       
        // echo '<br>';
        // echo '<p>Next 7 days from the current date are as shown below</p>';
       
        // foreach($weekOfdays as $days){
       
        //     echo $days.'<br>';
        // }
        $dateValue= "2015/07/15";
       
    }

}
