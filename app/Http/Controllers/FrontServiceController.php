<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentCreated;
use App\Notifications\AppointmentCreated as AppointmentCreatedNotification;
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
        $services = $user->services;
        $allUserAppointments = [];
        foreach ($user->services as $service) {
            $allUserAppointments = array_merge($allUserAppointments, $service->appointments->toArray());
        }
        // dd($services, $allUserAppointments);
        return view('booking.service', compact('user', 'allUserAppointments'));
    }

    public function indexSingleService($serviceId, $id){
        $service = Service::find($serviceId);
        $user = User::findOrFail($id);
        $allUserAppointments = $service->appointments;
        return view('booking.service-single', compact('user', 'allUserAppointments', 'service'));
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
            Mail::to($user->email)->send(new AppointmentCreated($appointment, 'owner'));
            Mail::to($appointment->email)->send(new AppointmentCreated($appointment, 'client'));
            $user->notify(new AppointmentCreatedNotification($appointment));

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

    public function displayAppointment($id){
        $appointment = Appointment::findOrFail($id);
        // $appointment->status = 'cancelled';
        // $appointment->save();
        // $service = $appointment->service;
        // $user = $service->user;
        // $user->consommation++;
        // $user->save();
        // $appointment->delete();
        return view('booking.cancel-appointment', compact('appointment'));
    }

    public function cancelAppointment(Request $request){
        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment cancelled successfully!');

    }
}
