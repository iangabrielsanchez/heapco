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
        

        $path = $request->file('file')->store('files');
        //files/IY6NmjIC8kj7p18oLZrhpsvJ44PKj3apGc1MkV8p.png

        
        $file = new File;
        $file->patient_id = $request->patient_id;
        $file->title = $request->title;
        $file->description = $request->description;
        $file->path = $path;
        $file->personnel_id = session('accountID');
        $file->save();
        return back();
        
    }

}
