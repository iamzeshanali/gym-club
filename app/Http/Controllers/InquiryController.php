<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->name == 'admin'){
            $inquiries = Inquiry::all();
        }else{
            $clubs = Club::where('id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
            $inquiries = Inquiry::where('club_id',$clubs[0]->id)->get();
        }

        return view('dashboard/pages/inquiry/inquiries', compact('inquiries'));
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
        $last = Inquiry::latest()->first();
        if(isset($last)){
            $code = 'member-'.$last->id+1;
        }else{
            $code = 'member-1';
        }
        return view('dashboard/pages/inquiry/add-edit-inquiry', compact('clubs','code'));
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
            'inquiry_code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'inquiry_text' => 'required',
            'enrollment_status' => 'required',
            'followups' => 'required',
            'source' => 'required',
            'reference' => 'required',
        ]);

        $inquiry = new Inquiry();
        $inquiry->club_id = $request->club;
        $inquiry->inquiry_code = $request->inquiry_code;
        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->mobile = $request->mobile;
        $inquiry->inquiry_text = $request->inquiry_text;
        if ($request->status){
            $inquiry->status = $request->status;
        }else{
            $inquiry->status = 'pending';
        }
        $inquiry->enroll_status = $request->enrollment_status;
        $inquiry->followup = $request->followups;
        $inquiry->comments = $request->comment;
        $inquiry->note = $request->note;
        $inquiry->source = $request->source;
        $inquiry->reference = $request->reference;
        $inquiry->save();

        return redirect()->route('dashboard.inquiries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Inquiry $inquiry)
    {
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
        }else{
            $clubs = Club::where('id',\Illuminate\Support\Facades\Session::get('club_id'))->get();
        }

        return view('dashboard/pages/inquiry/add-edit-inquiry', compact('clubs', 'inquiry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'club' => 'required',
            'inquiry_code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'inquiry_text' => 'required',
            'enrollment_status' => 'required',
            'followups' => 'required',
            'source' => 'required',
            'reference' => 'required',
        ]);

        $inquiry->club_id = $request->club;
        $inquiry->inquiry_code = $request->inquiry_code;
        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->mobile = $request->mobile;
        $inquiry->inquiry_text = $request->inquiry_text;
        if ($request->status){
            $inquiry->status = $request->status;
        }else{
            $inquiry->status = 'pending';
        }
        $inquiry->enroll_status = $request->enrollment_status;
        $inquiry->followup = $request->followups;
        $inquiry->comments = $request->comment;
        $inquiry->note = $request->note;
        $inquiry->source = $request->source;
        $inquiry->reference = $request->reference;
        $inquiry->save();

        return redirect()->route('dashboard.inquiries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('dashboard.inquiries.index');
    }
}
