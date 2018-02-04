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
        $file = new File;
        $file->patient_id = $request->patient_id;
        $file->title = $request->title;
        $file->description = $request->description;
        
        $path = $request->file('file')->store('public');
        
        $path = explode('/',$path)[1];
        return Storage::url($path);
        $file->path = $path;
        return asset("storage/${path}");
        
        $file->personnel_id = session('accountID');
        $file->save();
        
    }

}
