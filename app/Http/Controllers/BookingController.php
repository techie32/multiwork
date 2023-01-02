<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

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
        // $request->validate([
        //     'name' => 'required',
        //     'zip_code' => 'required',
        //     'service_type' => 'required',
        //     'model' => 'required',
        //     'device_issue_name' => 'required',
        //     'device_issue_description' => 'required',
        //     'screen_color' => 'required',
        //     'warrenty' => 'required',
        //     'screen_protector' => 'required',
        //     'charger_cable' => 'required',
        //     'date' => 'required',
        //     'time' => 'required',
        //     'address' => 'required',
        //     'unit_floor' => 'required',
        //     'phone' => 'required',
        //     'email' => 'required',
        //     'total_price' => 'required',
            
        // ]);

        return Booking::create($request->all());
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
        $bookings = Booking::all();
        return view('Admin.booking_list',compact('bookings'));
    }
}
