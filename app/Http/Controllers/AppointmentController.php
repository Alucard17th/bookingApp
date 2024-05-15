<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentStatusUpdatedClientsMail;
use App\Notifications\AppointmentCreated as AppointmentCreatedNotification;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the authenticated user's services
        $services = auth()->user()->services;
        $appointments = collect();

        // Loop through each service
        foreach ($services as $service) {
            // Retrieve the appointments associated with the current service using eager loading
            $serviceAppointments = $service->appointments()->get();
            
            // Merge the appointments into the $appointments collection
            $appointments = $appointments->merge($serviceAppointments);
        }

        // Pass the $appointments collection to the view
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $services = auth()->user()->services;
        return view('admin.appointments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $appointment = new Appointment;
            $appointment->name = $request->name;
            $appointment->email = $request->email;
            $appointment->phone = $request->phone;
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->service_id = $request->service_id;
            $appointment->save();

            // Mail::to($appointment->email)->send(new AppointmentCreated($appointment));
            $user = auth()->user();
            $user->notify(new AppointmentCreatedNotification($appointment));
            Mail::to($appointment->email)->send(new AppointmentCreated($appointment, 'client'));

            return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'An error occurred while creating the appointment.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
        return view('admin.appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
        $appointment->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            // 'service_id' => $request->service_id,
            'status' => $request->status && $request->status == 'on' ? 'active' : 'cancelled',
        ]);

        Mail::to($appointment->email)->send(new AppointmentStatusUpdatedClientsMail($appointment, $appointment->name));
    
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
    
    public function indexJson()
    {
        $services = auth()->user()->services;
        $appointments = collect();

        // Loop through each service
        foreach ($services as $service) {
            // Retrieve the appointments associated with the current service using eager loading
            $serviceAppointments = $service->appointments()->get();
            
            // Merge the appointments into the $appointments collection
            $appointments = $appointments->merge($serviceAppointments);
        }
        return response()->json($appointments);
    }
}
