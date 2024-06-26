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
    
        $mobile = new Mobile_info();
        $mobile->mobile_name = $request->mobile_name;
        $mobile->model = $request->model;
        $mobile->battery_replacement_price = $request->battery_replacement_price;
        $mobile->screen_replacement_price = $request->screen_replacement_price;
        if($request->input('modelcategory')){
            $arraytostring = implode(',',$request->input('modelcategory'));
            $mobile->modelcategory =  $arraytostring;
        }else{
            $mobile->modelcategory = "Black Screen";
        }   
        $mobile->warrenty_name =   $request->warrenty_name;
        $mobile->warrenty_price =  $request->warrenty_price; 
        $mobile->image =  base64_encode(file_get_contents($request->file('image')));
      
        $mobile->save();
        
    
        return Redirect()->route('all-mobile');
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
        return view('Admin.edit_mobile',compact('mobile'));
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
      
        $mobile = Mobile_info::find($id);
        $mobile->mobile_name = $request->mobile_name;
        $mobile->model = $request->model;
        $mobile->battery_replacement_price = $request->battery_replacement_price;
        $mobile->screen_replacement_price = $request->screen_replacement_price;
        if($request->input('modelcategory')){
            $arraytostring = implode(',',$request->input('modelcategory'));
            $mobile->modelcategory =  $arraytostring;
        }else{
            $mobile->modelcategory = "Black Screen";
        }   
        
        $mobile->warrenty_name =   $request->warrenty_name;
        $mobile->warrenty_price =  $request->warrenty_price; 
      
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $mobile->image =  base64_encode(file_get_contents($request->file('image')));
        }else{
            $mobile->image =  $request->image; 
        }
    
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
