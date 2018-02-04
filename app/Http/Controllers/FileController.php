<?php

namespace App\Http\Controllers;

use Storage;
use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function index(Request $request)
    {
        return File::where('patient_id',$request->id)->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $fileName = hash("md5",str_random(40)).$file->getClientOriginalName();
        $file->move("files", $fileName);
        return $file;
        // $file = new File;
        // $file->patient_id = $request->patient_id;
        // $file->title = $request->title;
        // $file->description = $request->description;
        
        // $path = $request->file('file');
        // $fileName = explode('/',$path)[1];
        // $path = $path->move(public_path(),$fileName);
        // return $path;
        // $fileName = explode('/',$path)[1];
        // return Storage::url($path);
        // $file->path = $path;
        // return asset("storage/${path}");
        
        // $file->personnel_id = session('accountID');
        // $file->save();
        
    }

}
