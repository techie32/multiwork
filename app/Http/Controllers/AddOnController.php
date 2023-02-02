<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddOn;
class AddOnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AddOn::all();
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
        $addon = new AddOn();
        $addon->addon_name = $request->addon_name;
        $addon->price = $request->price;
        $addon->image =  base64_encode(file_get_contents($request->file('image')));
        $addon->save();
    
        return Redirect()->route('all-addon');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return AddOn::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addon = AddOn::where('id' ,'=',$id)->first();
        return view('Admin.edit_addon',compact('addon'));
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
        $addon = AddOn::find($id);
        $addon->addon_name = $request->addon_name;
        $addon->price = $request->price;
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $addon->image =  base64_encode(file_get_contents($request->file('image')));
        }else{
            $addon->image =  $request->image; 
        }
        if($addon->save())
        {
            return redirect()->route("all-addon");
        }
        else
        {
            return redirect()->back()->with(['msg' => 2]);
        }
        return view('addon.edit',compact('addon'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addon =  AddOn::find($id);
        if($addon->delete())
        {
            return redirect()->back()->with(['msg' => 1]);
        }
        else
        {
            return redirect()->back()->with(['msg' => 2]);
        }
    }
    
    public function AllAddOn()
    {
        $addon = AddOn::all();
        return view('Admin.addon_list',compact('addon'));
    }
}


