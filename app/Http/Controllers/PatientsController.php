<?php

namespace App\Http\Controllers;

use DB;
use App\Patient;
use App\User;
use App\File;
use App\Post;
use Illuminate\Http\Request;

class PatientsController extends Controller
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
        $patients = Patient::all();
        return view('patients')->with(compact('patients'));
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
        $patient = new Patient;
        $patient->email = $request->email;
        $patient->address = $request->address;
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->sex = $request->sex;
        $patient->birth_date = $request->birth_date;
        $patient->contact_number = $request->contact_number;
        $path = $request->file('file')->store('files');
        $patient->image_location = $path;
        $patient->save();
        User::create([
            'name' => $request->first_name .' '. $request->last_name,
            'email' => $request->email,
            'password' => bcrypt(strtolower($request->last_name . explode('-',$request->birth_date)[0])),
        ]);
        return back();
        //return redirect("patients/$patient->id");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $files =File::where('patient_id',$patient->id)->get();
        $posts = DB::table('posts')->where('patient_id',$patient->id)
            ->join('personnel_profiles', 'posts.doctor_id', '=', 'personnel_profiles.id')
            ->join('patients', 'posts.patient_id', '=', 'patients.id')
            ->select(
                'posts.*', 
                'personnel_profiles.id as personnel_id', 
                'personnel_profiles.email as personnel_email', 
                'personnel_profiles.type as  personnel_type', 
                'personnel_profiles.first_name as personnel_first_name', 
                'personnel_profiles.last_name as personnel_last_name', 
                'personnel_profiles.sex as personnel_sex', 
                'personnel_profiles.birth_date as personnel_birth_date', 
                'personnel_profiles.hospital_id as personnel_hospital_id', 
                'personnel_profiles.contact_number as personnel_contact_number',
                'patients.id as patient_id',
                'patients.first_name as patient_first_name',
                'patients.last_name as patient_last_name',
                'patients.sex as patient_sex',
                'patients.birth_date as patient_birth_date',
                'patients.address as patient_address',
                'patients.contact_number as patient_contact_number',
                'patients.email as patient_email')
            ->get();
        return view('patient')
            ->with(compact('patient'))
            ->with(compact('files'))
            ->with(compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
