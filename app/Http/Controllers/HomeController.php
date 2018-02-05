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

        // $events[] = \Calendar::event(
        //     "Sample",
        //     true,
        //     '2018-02-05T1000',
        //     '2018-02-05T1200'
        // );
        return view('home');

        // $calendar = \Calendar::addEvents($events)->setOptions(['firstDay' => 1])->setCallbacks([]);
        // return view('home', array('calendar'=>$calendar));
    }
}
