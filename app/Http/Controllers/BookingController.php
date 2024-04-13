<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookings = Booking::all();
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if(auth()->guest()){
            return view('admin.bookings.create');
        }
        $events = auth()->user()->events;

        return view('admin.bookings.create', compact('events'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'date_start' => 'date',
            'date_end' => 'date',
            // 'time' => 'required|date_format:H:i',
            'event_id' => 'required|exists:events,id'
        ]);

        // Create a new booking instance
        $booking = new Booking();
        $booking->name = $validatedData['name'];
        $booking->email = $validatedData['email'];
        $booking->phone = $validatedData['phone'];
        $booking->date = $validatedData['date'];
        $booking->date_start = $validatedData['date_start'] ?? $validatedData['date'] ?? null; 
        $booking->date_end = $validatedData['date_end'] ?? $validatedData['date'] ?? null;
        // $booking->time = $validatedData['time'];
        $booking->event_id = $validatedData['event_id'];
        $booking->save();

        // Redirect to the index page
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }


    // FRONT 

    public function indexFront($id, $eventId)
    {
        //
        $user = User::findOrFail($id);

        $event = Event::findOrFail($eventId);
        return view('booking.index', compact('user', 'event'));
    }
}
