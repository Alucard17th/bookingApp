<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;

class FrontEventController extends Controller
{
    //
    public function index($id, $eventId)
    {
        //
        $user = User::findOrFail($id);
        $event = Event::findOrFail($eventId);
        return view('booking.events.index', compact('user', 'event'));
    }

    public function store(Request $request)
    {
        //
        $booking = new Booking;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->date = $request->date;
        $booking->event_id = $request->event_id;
        $booking->save();

        return redirect()->route('front.service.booking.thanks');
    }
}
