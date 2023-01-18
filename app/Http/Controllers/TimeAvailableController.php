<?php

namespace App\Http\Controllers;
use App\Models\Time_available;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Carbon\CarbonPeriod;
use DateTime;
use App\Models\LeadTime;
use App\Models\Booking;
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

    public function calculatenextslot($givendate){

        $weekDays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

        $availableDays = DB::table('time_available')
                ->select('*')
                ->where('active','=',1)
                ->get();

        $daysInAvailableDays = [];
        foreach($availableDays as $key => $value){
            $daysInAvailableDays[] = $value->day_name;
        }
    

        $changeformat = $givendate;
        
        $date =  new Carbon($changeformat);

        $leadtime = LeadTime::get();
        $leadtimevalue = $leadtime[0]->lead_time;
        
        $daysWithSlots = [];
        $index = 0;
        while (count($daysWithSlots) < 7) {
            // dd($daysWithSlots);
            // $date->modify('+1 day');
            $current_time = carbon::now();
            $created_at = $current_time->format("H:i:s");
           
            if (in_array($weekDays[$date->format('w')], $daysInAvailableDays))
            {
                $specificDay = '';
                foreach($availableDays as $key => $value){
                    if($value->day_name == $weekDays[$date->format('w')] ){
                        $specificDay = $value;
                    }
                }
      
                // $restrictStartTime = Carbon::createFromTime(Carbon::now());
                // $restrictStartTime->toDateTimeString();
                // dd($restrictStartTime);
                $period = new CarbonPeriod($specificDay->start_time, $leadtimevalue, $specificDay->end_time); 
                // dd($specificDay->start_time);
                // dd($created_at);
                if($created_at > $specificDay->start_time)
                { 
                    
                    for($i = 0;$i < $specificDay->start_time; $i++){
                       $z = $specificDay->start_time;

                       $z++;

                    }
                    dd($z);
                }
                // dd($specificDay->start_time);

                 /**
                  * if(index === 0){

                     time from FE 
                    

                     if fe < start time 
                     loop filter 

              
                  */


            //    $test = (int)$specificDay->start_time - (int)$created_at;
            //    if($test < 0){ 
            //     dd($test);

            //    }else{
            //     dd("remain");
            //    }
               
                // $currentHour = Carbon::now()->hour;
                // dd($currentHour);
                // $startTime = '0';
                // $endTime = '6';
                // $start  = $this->startTime > $this->endTime ? !($this->startTime <= $currentHour) : $this->startTime <= $currentHour;
                // $end = $currentHour < $this->endTime;
                $start = ('22:0:0'); 
                 $end = ('08:0:0');  
                $now = Carbon::now('UTC'); 
                // dd($now);

                if( $start < $now->hour && $now->hour < $end){
                        // Do something
                        dd("nsd'_");
                 }
  
                $slots = [];
                
                foreach($period as $item){
                    array_push($slots,$item->format("h:i A"));
                } 
                
                $datenew = $date->format('Y-m-d');
                $bookedslot = Booking::where('date' , '=', $datenew)->get();
                
                $bookslotdata = [];
                foreach($bookedslot as $key => $value){
                    $bookslotdata[] = $value->time;
                }
                
                $allslot =  $slots;
                $doneslot = $bookslotdata;

                $filterslot = array_diff($allslot, $doneslot);
                $slots = $filterslot;
                
                $daysWithSlots[] = [
                  'date' => $date->format('Y-m-d'),
                  'slots' =>  $slots,
                  'dayName' => $weekDays[$date->format('w')],
                ];
                
            }
            // dd($daysWithSlots);
            $index = $index+1;
        }
        // dd($daysWithSlots);
        

        return $daysWithSlots;
        
       
    }

    public function calculatepreviousslot($givendate){

        $weekDays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      
        $availableDays = DB::table('time_available')
                ->select('*')
                ->where('active','=',1)
                ->get();

        $daysInAvailableDays = [];
        foreach($availableDays as $key => $value){
            $daysInAvailableDays[] = $value->day_name;
        }

        $l = $givendate;
        $date =  new Carbon($l);

        $leadtime = LeadTime::get();
        $leadtimevalue = $leadtime[0]->lead_time;

        $daysWithSlots = [];
        while (count($daysWithSlots) < 7) {
            $date->modify('-1 day');
            if (in_array($weekDays[$date->format('w')], $daysInAvailableDays)) {

                $specificDay = '';
                foreach($availableDays as $key => $value){
                    if($value->day_name == $weekDays[$date->format('w')] ){
                        $specificDay = $value;
                    }
                }
                $period = new CarbonPeriod($specificDay->start_time, $leadtimevalue, $specificDay->end_time); 
                $slots = [];
                foreach($period as $item){
                    array_push($slots,$item->format("h:i A"));
                } 
                $datenew = $date->format('Y-m-d');
                $bookedslot = Booking::where('date' , '=', $datenew)->get();
                
                $bookslotdata = [];
                foreach($bookedslot as $key => $value){
                    $bookslotdata[] = $value->time;
                }
                
                $allslot =  $slots;
                $doneslot = $bookslotdata;

                $filterslot = array_diff($allslot, $doneslot);
                $slots = $filterslot;
              
                $daysWithSlots[] = [
                  'date' => $date->format('Y-m-d'),
                  'slots' => $slots,
                  'dayName' => $weekDays[$date->format('w')],
                ];
            }
        }
        return $daysWithSlots;
       
    }

    public function TimeShow(){
        $timing = time_available::all();
        return view('Admin.time_sch',compact('timing'));
    }

   

}