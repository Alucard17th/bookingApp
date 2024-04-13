<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;

class FrontServiceController extends Controller
{
    //

    public function index($id, $serviceId){
        //
        $user = User::findOrFail($id);
        $service = service::findOrFail($serviceId);
        return view('booking.index', compact('user', 'service'));
    }

    public function store(Request $request){
        //
        $appointment = new Appointment;
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->service_id = $request->service_id;
        $appointment->save();

        return redirect()->route('front.service.booking.thanks');
    }

    public function getAppointmentByDayAndTime($day){
        //
        $appointment = Appointment::where('date', $day)->get();
        return response()->json($appointment);
    }

    public function thanks(){
        return view('booking.thanks');
    }
}
