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
use Illuminate\Support\Facades\Http;
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
        while(count($daysWithSlots) < 7) {
            $current_time = carbon::now();
           
            $time_modify = $current_time->modify('+1 hour');
           
            $created_at = $time_modify->format("H:i");
           
            if (in_array($weekDays[$date->format('w')], $daysInAvailableDays))
            {
            
                $specificDay = '';
                foreach($availableDays as $key => $value){
                    if($value->day_name == $weekDays[$date->format('w')] ){
                        $specificDay = $value;
                    }
                }
                    
                $period = new CarbonPeriod($specificDay->start_time, $leadtimevalue, $specificDay->end_time); 
                     
                $slots = [];
                   
                foreach($period as $item){
                    if($index == 0){
                        if(strtotime($created_at) < strtotime($item->format("h:i A")) ){
                            array_push($slots,$item->format("h:i A")); 
                        }
                    }else{
                        array_push($slots,$item->format("h:i A"));
                    }
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
            $date->modify('+1 day');
            $index = $index+1;
        }
        dd($daysWithSlots);
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
        $index = 0;
        $daysWithSlots = [];
        while (count($daysWithSlots) < 7) {
            $current_time = carbon::now();
            $time_modify = $current_time->modify('+1 hour');
            $created_at = $time_modify->format("H:i");
            
            if (in_array($weekDays[$date->format('w')], $daysInAvailableDays)) {

                $specificDay = '';
                foreach($availableDays as $key => $value){
                    if($value->day_name == $weekDays[$date->format('w')] ){
                        $specificDay = $value;
                    }
                }
                $period = new CarbonPeriod($specificDay->start_time, $leadtimevalue, $specificDay->end_time); 
                $current_time = Carbon::now();

                

                $slots = [];
                    
                foreach($period as $item){
                    if($index == 0){
                        if(strtotime($created_at) < strtotime($item->format("h:i A")) ){
                            array_push($slots,$item->format("h:i A")); 
                        }
                    }else{
                        array_push($slots,$item->format("h:i A"));
                    }
                        
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
            $date->modify('-1 day');
            $index = $index+1;
    
        }
        return $daysWithSlots;
       
    }

    public function TimeShow(){
        $timing = time_available::all();
        return view('Admin.time_sch',compact('timing'));
    }


    public function addPost(){
        $res = Http::post('https://reqres.in/api/users',[
            'name' => 'khaan'. ' ' . 'akia',
            'job' => 'dev'
        ]);
        dd($res->json());
    }
    

}