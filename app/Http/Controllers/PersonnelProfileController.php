<?php

namespace App\Http\Controllers;

use App\PersonnelProfile;
use Storage;
use App\Hospital;
use App\User;
use Illuminate\Http\Request;

class PersonnelProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnelProfiles = PersonnelProfile::all();
        $hospitals = Hospital::all();
        return view('accounts')->with(compact('personnelProfiles'))->with(compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect("accounts");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new PersonnelProfile;
        $profile->email = $request->email;
        $profile->password = bcrypt($request->password);
        $profile->type = $request->type;
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->sex = $request->sex;
        $profile->birth_date = $request->birth_date;
        $profile->hospital_id = $request->hospital_id;
        $profile->contact_number = $request->contact_number;
        $path = $request->file('image')->store('files');
        Storage::setVisibility($path, 'public');
        $profile->image_location = $path;
        $profile->save();
        User::create([
            'name' => $request->first_name .' '. $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonnelProfile  $personnelProfile
     * @return \Illuminate\Http\Response
     */
    public function show(PersonnelProfile $account)
    {
        //$account = PersonnelProfile::find($personnelProfile);
        return view('account', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonnelProfile  $personnelProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonnelProfile $personnelProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonnelProfile  $personnelProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonnelProfile $personnelProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonnelProfile  $personnelProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonnelProfile $personnelProfile)
    {
        //
    }
}
