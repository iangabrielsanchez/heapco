<?php

namespace App\Http\Controllers;

use Storage;
use DB;
use App\Post;
use App\Comment;
use App\Patient;
use App\Relationship;
use App\PersonnelProfile;
use Illuminate\Http\Request;

class PostsController extends Controller
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
        $rels = Relationship::where('doctor_id',session('accountID'))->get()->pluck('patient_id');
        $posts = [];

        $posts = DB::table('posts')
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
                'patients.email as patient_email');
                
        foreach($rels as $patient_id){
            $posts = $posts->orWhere('posts.patient_id', $patient_id);
        }
        $posts = $posts->get();
        // return $posts;
        $patients = Patient::all();
        $doctors = PersonnelProfile::all();
        return view('forums', compact('posts'))->with(compact('patients'))->with(compact('doctors'));
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
        $post = new Post;
        $post->doctor_id = $request->doctor_id;
        $post->patient_id = $request->patient_id;
        $post->topic = $request->topic;
        $post->content = $request->content;
        $post->status = $request->status;
        $path = null;
        if ($request->file('file') !== null){
            $path = $request->file('file')->store('files');
            Storage::setVisibility($path, 'public');
        }
        $post->file_location = $path;
        $post->save();
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = DB::table('posts')
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
            ->where('posts.id', $id)
            ->first();
        //$comments = Comment::where('post_id', $id)->get();
        $comments = DB::table('comments')->join('personnel_profiles', 'comments.doctor_id', '=', 'personnel_profiles.id')
            ->where('post_id',$id)
            ->select('comments.*',
                'personnel_profiles.id as personnel_id', 
                'personnel_profiles.email as personnel_email', 
                'personnel_profiles.type as  personnel_type', 
                'personnel_profiles.first_name as personnel_first_name', 
                'personnel_profiles.last_name as personnel_last_name', 
                'personnel_profiles.sex as personnel_sex', 
                'personnel_profiles.birth_date as personnel_birth_date', 
                'personnel_profiles.hospital_id as personnel_hospital_id', 
                'personnel_profiles.contact_number as personnel_contact_number')
            ->get();
        $patients = Patient::all();
        $doctors = PersonnelProfile::all();
        $withImage = false;
        if (PostsController::endsWith($post->file_location, [".jpg",".jpeg",".gif",".png",".bmp"])){
            $withImage = true;
        }
        //return compact('post')->with(compact('withImage'));
        return view('post', compact('post'))->with(compact('patients'))->with(compact('doctors'))->with(compact('comments'))->with(compact('withImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    private function endsWith($string, $testArray) {
        foreach($testArray as $test){
            $string = strtolower($string);
            $test = strtolower($test);
            $strlen = strlen($string);
            $testlen = strlen($test);
            if ($testlen > $strlen) continue;
            if (substr_compare($string, $test, $strlen - $testlen, $testlen) !== 0) continue;
            return true;
        }
        return false;
    }
}
