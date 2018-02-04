<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session("accountType") == "patient"){
            return redirect("/patients/".session('accountID'));
        }
        else if(session("accountType") == "doctor"){
            return redirect("/forums");
        }
        else if(session("accountType") == "nurse"){            
            return redirect("/patients");
        }
        return view('home');
    }
}
