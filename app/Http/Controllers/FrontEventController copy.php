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

      $event = Event::find($request->event_id);
      if(!$event->user->canBeBooked()){
          return dd(['error' => 'No more bookings allowed for this event']);
      }

      //
      $booking = new Booking;
      $booking->name = $request->name;
      $booking->email = $request->email;
      $booking->phone = $request->phone;
      $booking->date = $request->date;
      $booking->event_id = $request->event_id;

      $event = $booking->event; 
      $user = $event->user;
      $subscription = $user->subscription; 

      if ($subscription) {
          $subscription->consommation--;
          $subscription->save(); // Explicitly save the subscription
          $booking->save(); // Save the booking after successful decrement
      } else {
        // Handle the case where the user doesn't have a subscription (e.g., error message)
        return dd(['error' => 'User does not have a subscription']);
      }

      // if ($subscription) {
      //     // Check if the user has enough 'consommation' remaining
      //     if ($subscription->consommation > 0) {
      //       $subscription->consommation--;
      //       $subscription->save(); // Explicitly save the subscription
      //       $booking->save(); // Save the booking after successful decrement
      //     } else {
      //       // Handle the case where there's no more 'consommation' left (e.g., error message)
      //       return dd(['error' => 'No more bookings allowed for this subscription']);
      //     }
      //   } else {
      //     // Handle the case where the user doesn't have a subscription (e.g., error message)
      //     return dd(['error' => 'User does not have a subscription']);
      // }

      return redirect()->route('front.service.booking.thanks');
    }
}