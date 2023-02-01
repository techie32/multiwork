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
            "services_title" => $request->service_type,
            "services_descriptions" => $request->device_issue_name . ' ' . $request->screen_protector . ' ' . $request->warrenty,
            "services_cost" =>$request->total_price,
            "start" =>$request->date,
            "consumers_name" =>$request->name,
            "consumers_email" =>$request->email,
            "consumers_mobile" =>$request->phone,
            "consumers_address_zip" => $request->zip_code,
            "consumers_address_line1" => $request->address,
            "consumers_additionalFields_coupon_code" =>$request->unit_floor . ' ' . $request->applied_coupon_code,
            "add_ons" =>$request->screen_protector,
        ]);

        dd($response->json());
       
        
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

}
