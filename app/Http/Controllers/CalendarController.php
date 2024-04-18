<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function indexAppointments(){

        return view('admin.calendar.appointments');
    }

    public function indexEvents(){

        return view('admin.calendar.events');
    }
}
