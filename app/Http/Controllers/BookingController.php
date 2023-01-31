<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use DB;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Booking::all();
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

        $booking = new Booking;
        $booking->zip_code = $request->zip_code;
        $booking->service_type = $request->service_type;
        $booking->model = $request->model;
        $booking->device_issue_name = $request->device_issue_name;
        $booking->screen_color = $request->screen_color;
        $booking->warrenty = $request->warrenty;
        $booking->screen_protector = $request->screen_protector;
        $booking->charger_cable = $request->charger_cable;
        $booking->date = $request->date; 
        $booking->time = $request->time;
        $booking->address = $request->address;
        $booking->unit_floor = $request->unit_floor;
        $booking->name = $request->name;
        $booking->phone = $request->phone;
        $booking->email = $request->email;
        $booking->coupon_code = $request->applied_coupon_code;
        $booking->total_price = $request->total_price;

        $booking->save();
     
        $response = Http::post('https://hooks.zapier.com/hooks/catch/7959662/bjvfjg4/' ,[
            "services_title" => $booking->service_type,
            "services_descriptions" => $booking->device_issue_name ,
            "services_cost" =>$booking->total_price,
            "start" =>$booking->date,
            "consumers_name" =>$booking->name,
            "consumers_email" =>$booking->email,
            "consumers_mobile" =>$booking->phone,
            "consumers_address_zip" => $booking->zip_code,
            "consumers_address_line1" => $booking->address,
            "consumers_additionalFields_coupon_code" =>$booking->unit_floor,
            "add_ons" =>$booking->screen_protector,
        ]);
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Booking::find($id);
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
        return Booking::find($id)->delete();

    }
    public function Allbooking()
    {
        $bookings = Booking::all()->reverse()->values();

        // $bookings = DB::table('booking')->select(DB::raw('*'))
        // ->whereRaw('Date(created_at) = CURDATE()')->get();
        // dd($records);

        return view('Admin.booking_list',compact('bookings'));
    }

    public function test(){
        $booking = Booking::all()->last();
      
        $booked = [
            "services_title" => $booking->service_type,
            "services_descriptions" => $booking->device_issue_name ,
            "services_cost" =>$booking->total_price,
            "start" =>$booking->date,
            "consumers_name" =>$booking->name,
            "consumers_email" =>$booking->email,
            "consumers_mobile" =>$booking->phone,
            "consumers_address_zip" => $booking->zip_code,
            "consumers_address_line1" => $booking->address,
            "consumers_additionalFields_coupon_code" =>$booking->unit_floor,
            "add_ons" =>$booking->screen_protector,
        ];
        
        return $booked;
    }
}
