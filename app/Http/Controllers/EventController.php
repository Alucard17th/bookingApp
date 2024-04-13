<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = auth()->user()->events()->orderBy('id', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            // 'time' => 'required|date_format:H:i',
            // 'location' => 'required|string|max:255',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('image')) {
            // $request->validate([
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // ]);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/events/'.auth()->user()->id), $imageName);
        }
        
        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time ?? '00:00:00',
            'location' => $request->location,
            'image' => $imageName ?? '',
            'status' => 'active',
            'user_id' => auth()->id(),
            'type' => $request->event_type,
            'cost' => $request->cost ?? 0,
            'max_participants' => $request->max_participants
        ]);

        if ($request->has('availabilities')) {
            foreach ($request->availabilities as $availabilityData) {
                $availability = new Availability();
                $availability->start_at = $availabilityData['start_date_time'];
                $availability->end_at = $availabilityData['end_date_time'];
                $availability->event_id = $event->id; // Associate the availability with the event
                $availability->save();
            }
        }

        return redirect()->route('events.index')->with('success','Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
        // Update the event data
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->time = $request->input('time');
        $event->location = $request->input('location');
        $event->cost = $request->input('cost');
        $event->status = $request->input('status');
        $event->max_participants = $request->input('max_participants');

        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/events/'.auth()->user()->id), $imageName);
        }

        $event->image = $imageName ?? $event->image;

        // Save the updated event data
        $event->save();

        // Redirect to the event show page with a success message
        return redirect()->route('events.show', $event->id)->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();
        return redirect()->route('events.index')->with('success','Event deleted successfully.');
    }
}
