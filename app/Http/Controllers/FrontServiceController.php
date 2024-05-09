<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;

class FrontServiceController extends Controller
{
    //

    public function index($id, $serviceId, Request $request){
        //
        $user = User::findOrFail($id);
        $service = Service::findOrFail($serviceId);
        return view('booking.index', compact('user', 'service'));
    }

    public function indexNew($id){
        //
        $user = User::findOrFail($id);
        return view('booking.service', compact('user'));
    }

    public function store(Request $request){
        //
        $service = Service::find($request->service_id);
        if(!$service->user->canBeBooked()){
            return dd(['error' => 'No more bookings allowed for this service']);
        }
        $appointment = new Appointment;
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->service_id = $request->service_id;

        $service = $appointment->service; 
        $user = $service->user;
        $canBeBooked = $user->canBeBooked(); 

        if ($canBeBooked) {
            $user->consommation++;
            $user->save(); // Explicitly save the subscription
            $appointment->save(); // Save the booking after successful decrement
        } else {
          // Handle the case where the user doesn't have a subscription (e.g., error message)
          return dd(['error' => 'User does not have a subscription']);
        }

        return redirect()->route('front.service.booking.thanks');
    }

    public function checkAvailability($day){
        //
        $user = auth()->user();
        $timeoff = $user->timeoff;
        $appointment = Appointment::where('date', $day)->get();
        $data = compact('appointment', 'timeoff');
        return response()->json($data);
    }

    public function thanks(){
        return view('booking.thanks');
    }

    public function getUserService(Request $request){
        $service = Service::findOrFail($request->service_id);
        return response()->json($service);
    }
}
