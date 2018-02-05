<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;


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
        $events[] = \Calendar::event(
            "Sample",
            true,
            '1960-02-06T00:00',
            '1960-02-07T00:00'
        );
        if(session("accountType") == "patient"){
            return redirect("/patients/".session('accountID'));
        }
        else if(session("accountType") == "doctor"){
            return redirect("/forums");
            $events[] = \Calendar::event(
                "Sample",
                true,
                '1960-02-06T00:00',
                '1960-02-07T00:00'
            );

            $as = Appointment::where('doctor_id',1)->get();

            foreach($as as $a){
                $temp = \Calendar::event(
                    "Sample",
                    false,
                    '2018-02-06T00:00',
                    '2018-02-07T00:00'
                );
                // $events = array_merge($temp, $events);

                array_push($events, $temp);
            }
            // return $events;
            // $event2[] = \Calendar::event(
            //     "Sample",
            //     true,
            //     '2018-02-06T00:00',
            //     '2018-02-07T00:00'
            // );
            // return $events;
            // return view('home');

            $calendar = \Calendar::addEvents($events)->setOptions(['firstDay' => 1])->setCallbacks([]);
            return view('home', array('calendar'=>$calendar));
        }
        else if(session("accountType") == "nurse"){            
            return redirect("/patients");
        }
        $calendar = \Calendar::addEvents($events)->setOptions(['firstDay' => 1])->setCallbacks([]); 
        return view('home', array('calendar'=>$calendar));
    }
}
