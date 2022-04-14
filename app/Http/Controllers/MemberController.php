<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->name == 'admin'){
            $members = Member::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
            $members = Member::where('club_id',$clubs[0]->id)->get();
        }

        return view('dashboard/pages/members/members', compact('members'));
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
            $memberships = Membership::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
            $memberships = Membership::where('club_id',$clubs[0]->id)->get();
        }

        return view('dashboard/pages/members/add-edit-members', compact('clubs', 'memberships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'club' => 'required',
            'member_code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'member_image' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'enrollment_type' => 'required',
            'enrollment_date' => 'required',
            'membership' => 'required'
        ]);

        $member = new Member();
        $member->club_id = $request->club;
        $member->membership_id = $request->membership;
        $member->member_code = $request->member_code;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->mobile = $request->mobile;

        $member_image = $request->member_image;
        if(isset($member->image)){
            if(isset($member_image)){
                if($member->image != $member_image){
                    $path = public_path('/images/'.$member->image);
                    if(File::exists($path)){
                        File::delete($path);
                        $member_image->move(public_path('images'), $member_image->getClientOriginalName());
                        $member->image = $member_image->getClientOriginalName();
                    }
                }
            }
        }else{
            $member_image->move(public_path('images'), $member_image->getClientOriginalName());
            $member->image = $member_image->getClientOriginalName();
        }
        $member->dob = $request->dob;
        $member->gender = $request->gender;
        $member->member_type = $request->member_type;
        $member->member_role = $request->member_role;
        $member->start_date = $request->start_date;

        $member->enrollment_type = $request->enrollment_type;
        $member->enrollment_date = $request->enrollment_date;

        $member->status = $request->status;
        $member->comments = $request->comment;
        $member->note = $request->note;
//        dd($member);
        $member->save();


        return redirect()->route('dashboard.members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        if(Auth::user()->role->name == 'admin'){
            $clubs = Club::all();
            $memberships = Membership::all();
        }else{
            $clubs = Club::where('user_id',Auth::user()->id)->get();
            $memberships = Membership::where('club_id',$clubs[0]->id)->get();
        }

        return view('dashboard/pages/members/add-edit-members', compact('clubs', 'memberships', 'member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'club' => 'required',
            'member_code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'member_image' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'enrollment_type' => 'required',
            'enrollment_date' => 'required',
            'membership' => 'required'
        ]);
        $member->club_id = $request->club;
        $member->membership_id = $request->membership;
        $member->member_code = $request->member_code;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->mobile = $request->mobile;

        $member_image = $request->member_image;
        if(isset($member->image)){
            if(isset($member_image)){
                if($member->image != $member_image){
                    $path = public_path('/images/'.$member->image);
                    if(File::exists($path)){
                        File::delete($path);
                        $member_image->move(public_path('images'), $member_image->getClientOriginalName());
                        $member->image = $member_image->getClientOriginalName();
                    }
                }
            }
        }else{
            $member_image->move(public_path('images'), $member_image->getClientOriginalName());
            $member->image = $member_image->getClientOriginalName();
        }
        $member->dob = $request->dob;
        $member->gender = $request->gender;
        $member->member_type = $request->member_type;
        $member->member_role = $request->member_role;
        $member->start_date = $request->start_date;

        $member->enrollment_type = $request->enrollment_type;
        $member->enrollment_date = $request->enrollment_date;

        $member->status = $request->status;
        $member->comments = $request->comment;
        $member->note = $request->note;
//        dd($member);
        $member->save();


        return redirect()->route('dashboard.members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        if(isset($member->image)){
            $path = public_path('/images/'.$member->image);
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $member->delete();
        return redirect()->route('dashboard.members.index');
    }
}
