<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobile_info;
class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Mobile_info::all();
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
        // $image = $request->image;
        // $iname = $image->getClientOriginalName();
        // $image->storeAs('public/images',$iname);

        $mobile = new Mobile_info();
        $mobile->mobile_name = $request->mobile_name;
        $mobile->model = $request->model;
        $mobile->price = $request->price;
        $mobile->image =  base64_encode(file_get_contents($request->file('image')));
        // $mobile->image = $iname;
        $mobile->save();
        // $mobile->toArray();/
    
        return view('Admin.mobile_list',compact('mobile'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Mobile_info::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mobile = Mobile_info::where('id' ,'=',$id)->first();
        return view('admin.edit_mobile',compact('mobile'));
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
        // $image = $request->image;
        // $iname = $image->getClientOriginalName();
        // $image->storeAs('public/images',$iname);


        $mobile = Mobile_info::find($id);
        $mobile->mobile_name = $request->mobile_name;
        $mobile->model = $request->model;
        $mobile->price = $request->price;
        // $mobile->image = base64_encode(file_get_contents($request->file('image')->pat‌​h()));
        $imagepath = $request->file('image');
        // $image = "data:image/png;base64,".base64_encode(file_get_contents($imagePath));
        $mobile->image = $request->price;
        // $mobile->image = $iname;
        if($mobile->save())
        {
            return redirect()->route("all-mobile");
        }
        else
        {
            return redirect()->back()->with(['msg' => 2]);
        }

        return view('mobile.edit',compact('mobile'));
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

    public function Allmobile()
    {
        $mobile = Mobile_info::all();
        return view('Admin.mobile_list',compact('mobile'));
    }

    public function delete($id)
    {
        $mobile =  Mobile_info::find($id);
        if($mobile->delete())
        {
            return redirect()->back()->with(['msg' => 1]);
        }
        else
        {
            return redirect()->back()->with(['msg' => 2]);
        }

    }

}
