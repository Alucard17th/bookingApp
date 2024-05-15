<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Notifications\EventStatusUpdated;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceStatusUpdatedMail;	

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $services = auth()->user()->services()->orderBy('id', 'desc')->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'duration' => 'required|integer',
            'description' => 'required|string',
            'cost' => 'required|numeric',
            'location' => 'required|in:remote,in-person',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add other validation rules as needed
        ]);

        // Create a new service instance
        $service = new Service();
        $service->name = $validatedData['name'];
        $service->duration = $validatedData['duration'];
        $service->description = $validatedData['description'];
        $service->cost = $validatedData['cost'];
        $service->location = $validatedData['location'];
        $service->user_id = auth()->user()->id;
        $service->buffer_time = $request->buffer_time;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/services/'.auth()->user()->id), $imageName);
            $service->image = $imageName;
        }

        // Save the service
        $service->save();

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $service = Service::find($id);

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $service = Service::find($id);

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'duration' => 'required|integer',
            'description' => 'required|string',
            'cost' => 'required|numeric',
            'location' => 'required|in:remote,in-person',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add other validation rules as needed
        ]);
    
        // Retrieve the service
        $service = Service::findOrFail($id);
    
        // Update the service attributes
        $service->name = $validatedData['name'];
        $service->duration = $validatedData['duration'];
        $service->description = $validatedData['description'];
        $service->cost = $validatedData['cost'];
        $service->location = $validatedData['location'];
        $service->buffer_time = $request->buffer_time;
        $service->is_active = $request->is_active;
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/services/'.auth()->user()->id), $imageName);
            $service->image = $imageName;
        }
    
        // Save the updated service
        $service->save();

        foreach($service->appointments as $appointment) {
            $appointment->status = $request->is_active ? 'active' : 'cancelled';   
            $appointment->save();
            // Send email to clients
            Mail::to($appointment->email)->send(new ServiceStatusUpdatedMail($service, $appointment->name));
        }
        // Send event status update notification    
        $service->user->notify(new EventStatusUpdated($service));
    
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
