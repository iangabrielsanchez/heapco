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
        //add a really old appointment
        $temp[] = \Calendar::event(
            "work",
            false,
            "1886-01-01T00:00:00",
            "1886-01-01T00:00:00"
        );
        $calendar = \Calendar::addEvents($temp)->setOptions(['firstDay' => 1])->setCallbacks([]);
        if(session("accountType") == "patient"){
            return redirect("/patients/".session('accountID'));
        }
        else if(session("accountType") == "doctor"){
            $appointments = Appointment::where('doctor_id',session('accountID'))->get();
            // return $as;
            foreach($appointments as $appointment){
                $temp[] = \Calendar::event(
                    $appointment->event,
                    false,
                    $appointment->startTime,
                    $appointment->endTime
                );
                $calendar = \Calendar::addEvents($temp)->setOptions(['firstDay' => 1])->setCallbacks([]);
            }
            
            
            //$calendar = \Calendar::addEvents($events2)->setOptions(['firstDay' => 1])->setCallbacks([]);
            return view('home', array('calendar'=>$calendar));
        }
        else if(session("accountType") == "nurse"){            
            return redirect("/patients");
        }
        return redirect("/hospitals");
        // return view('home', array('calendar'=>$calendar));
    }
}
