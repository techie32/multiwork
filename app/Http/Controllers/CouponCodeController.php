<?php

namespace App\Http\Controllers;
use App\Models\Couponcode;
use Illuminate\Http\Request;

class CouponCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Couponcode::all();
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
        $coupon = new Couponcode();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->amount = $request->amount;
        $coupon->save();
        return Redirect()->route('all-coupon');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Couponcode::where('id' ,'=',$id)->first();
        return view('Admin.edit_coupon',compact('coupon'));
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
        $coupon = Couponcode::find($id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->amount = $request->amount;
    
        if($coupon->save())
        {
            return redirect()->route("all-coupon");
        }
        else
        {
            return redirect()->back()->with(['msg' => 2]);
        }

        return view('coupon.edit',compact('coupon'));
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
    public function Allcouponcode()
    {
        $coupon = Couponcode::all();
        return view('Admin.coupon_list',compact('coupon'));
    }
    public function delete($id)
    {
        $coupon =  Couponcode::find($id);
        if($coupon->delete())
        {
            return redirect()->back()->with(['msg' => 1]);
        }
        else
        {
            return redirect()->back()->with(['msg' => 2]);
        }

    }
    
}
