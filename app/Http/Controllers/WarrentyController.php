<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warrenty;

class WarrentyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Warrenty::all();
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
        $warrenty = new Warrenty();
        $warrenty->name = $request->name;
        $warrenty->price = $request->price;
        $warrenty->save();
    
        return Redirect()->route('all-warrenty');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Warrenty::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warrenty = Warrenty::where('id' ,'=',$id)->first();
        return view('Admin.edit_warrenty',compact('warrenty'));
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
        $warrenty = Warrenty::find($id);
        $warrenty->name = $request->name;
        $warrenty->price = $request->price;
      
        if($warrenty->save())
        {
            return redirect()->route("all-warrenty");
        }
        else
        {
            return redirect()->back()->with(['msg' => 2]);
        }

        return view('warrenty.edit',compact('warrenty'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warrenty =  Warrenty::find($id);
        if($warrenty->delete())
        {
            return redirect()->back()->with(['msg' => 1]);
        }
        else
        {
            return redirect()->back()->with(['msg' => 2]);
        }
    }
    
    public function Allwarrenty()
    {
        $warrenty = Warrenty::all();
        return view('Admin.warrenty_list',compact('warrenty'));
    }
}