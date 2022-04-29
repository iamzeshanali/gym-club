<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use App\Models\Club;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddOnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->name == 'admin'){
            $addons = AddOn::all();
        }else{
            if(\Illuminate\Support\Facades\Session::exists('club_id')){
                $addons = AddOn::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
            }else{
                $addons = [];
            }
        }

        return view('dashboard/pages/add-on/add-ons', compact('addons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        }
        $last = AddOn::where('club_id',\Illuminate\Support\Facades\Session::get('club_id'))->get();

        if(count($last) > 0){
            $code = 'addon-'.$last[count($last) - 1]->id+1;
        }else{
            $code = 'addon-1';
        }
        return view('dashboard/pages/add-on/add-edit-add-on', compact('clubs','code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'club' => 'required',
            'addon_code' => 'required',
            'addon_description' => 'required',
        ]);

        $addon = new AddOn();

        $addon->club_id = $request->club;

        if ($request->status){
            $addon->status = $request->status;
        }else{
            $addon->status = 'inactive';
        }

        $addon->add_on_code = $request->addon_code;
        $addon->add_on_description = $request->addon_description;
        $addon->save();

        return redirect()->route('dashboard.addons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddOn  $addOn
     * @return \Illuminate\Http\Response
     */
    public function show(AddOn $addOn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddOn  $addOn
     * @return \Illuminate\Http\Response
     */
    public function edit(AddOn $addon)
    {
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        }
        return view('dashboard/pages/add-on/add-edit-add-on', compact('clubs','addon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddOn  $addOn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddOn $addOn)
    {
        $request->validate([
            'club' => 'required',
            'addon_code' => 'required',
            'addon_description' => 'required',
        ]);


        $addOn->club_id = $request->club;

        if ($request->status){
            $addOn->status = $request->status;
        }else{
            $addOn->status = 'inactive';
        }

        $addOn->add_on_code = $request->addon_code;
        $addOn->add_on_description = $request->addon_description;
        $addOn->save();

        return redirect()->route('dashboard.addons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddOn  $addOn
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddOn $addon)
    {
        $addon->delete();
        return redirect()->route('dashboard.addons.index');
    }
}
