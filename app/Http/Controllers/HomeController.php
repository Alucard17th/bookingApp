<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get the authenticated user's events
        $events = auth()->user()->events;

        // Initialize variables to store total counts
        $totalEventsCount = $events->count();
        $totalServicesCount = auth()->user()->services->count();
        $totalBookingsCount = 0;
        $services = auth()->user()->services;
        $totalAppointments = 0;

        // Loop through each service
        foreach ($services as $service) {
            $totalAppointments += $service->appointments()->count();
        }

        // Loop through each event and sum up the bookings count
        foreach ($events as $event) {
            $totalBookingsCount += $event->bookings()->count();
        }

        // EVENT CHART DATA OPTIONS START______________
        // Get the first day of the current month
        $startOfMonth = Carbon::now()->startOfMonth();

        // Get the last day of the current month
        $endOfMonth = Carbon::now()->endOfMonth();

        // Retrieve events of the current month
        $events = auth()->user()->events()
                   ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                   ->get();

        // Initialize an array to store event counts by day
        $eventCountsByDay = [];
    
        // Loop through each event and count events by day
        foreach ($events as $event) {
            $day = Carbon::parse($event->created_at)->format('Y-m-d');
            if (!isset($eventCountsByDay[$day])) {
                $eventCountsByDay[$day] = 1;
            } else {
                $eventCountsByDay[$day]++;
            }
        }

        // Format data for ApexCharts
        $categories = [];
        $data = [];

        foreach ($eventCountsByDay as $day => $count) {
            $categories[] = $day;
            $data[] = $count;
        }

        // Construct options for ApexCharts
        $options = [
            'chart' => [
                'type' => 'line',
                'height' => '400px'
            ],
            'series' => [
                [
                    'name' => 'Events',
                    'data' => $data,
                    'color' => '#EE7B11'
                ]
            ],
            'xaxis' => [
                'categories' => $categories
            ],
            'yaxis' => [
                'tickAmount' => 3,
                'decimalsInFloat' => 0,
                'min' => 0
            ]
        ];
        // EVENT CHART DATA OPTIONS END______________

        // SERVICE CHART DATA OPTIONS START______________
        // Retrieve events of the current month
        $services = auth()->user()->services()
                   ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                   ->get();

        // Initialize an array to store event counts by day
        $serviceCountsByDay = [];
    
        // Loop through each event and count events by day
        foreach ($services as $service) {
            $day = Carbon::parse($service->created_at)->format('Y-m-d');
            if (!isset($serviceCountsByDay[$day])) {
                $serviceCountsByDay[$day] = 1;
            } else {
                $serviceCountsByDay[$day]++;
            }
        }

        // Format data for ApexCharts
        $categories = [];
        $data = [];

        foreach ($serviceCountsByDay as $day => $count) {
            $categories[] = $day;
            $data[] = $count;
        }

        // Construct options for ApexCharts
        $serviceOptions = [
            'chart' => [
                'type' => 'line',
                'height' => '400px'
            ],
            'series' => [
                [
                    'name' => 'Services',
                    'data' => $data,
                    'color' => '#EE7B11'
                ]
            ],
            'xaxis' => [
                'categories' => $categories
            ],
            'yaxis' => [
                'tickAmount' => 3,
                'decimalsInFloat' => 0,
                'min' => 0
            ]
        ];
        // SERVICE CHART DATA OPTIONS END______________

        // BOOKING CHART DATA OPTIONS START______________
        // Retrieve events of the current user with bookings within the current month
        $events = auth()->user()->events()
        ->with(['bookings' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        }])
        ->get();

        // Initialize an array to store booking counts by day
        $bookingCountsByDay = [];
        $lastBookings = [];

        // Loop through each event and count bookings by day
        foreach ($events as $event) {
            foreach ($event->bookings as $booking) {
                $day = Carbon::parse($booking->created_at)->format('Y-m-d');
                if (!isset($bookingCountsByDay[$day])) {
                    $bookingCountsByDay[$day] = 1;
                } else {
                    $bookingCountsByDay[$day]++;
                }
            }
        }

        // Format data for ApexCharts
        $categories = [];
        $data = [];

        foreach ($bookingCountsByDay as $day => $count) {
        $categories[] = $day;
        $data[] = $count;
        }

        // Construct options for ApexCharts
        $optionsBookings = [
            'chart' => [
                'type' => 'bar',
                'height' => '400px'
            ],
            'series' => [
                [
                    'name' => 'sales',
                    'data' => $data,
                    'color' => '#1642B9'
                ]
            ],
            'xaxis' => [
                'categories' => $categories
            ],
            'yaxis' => [
                'tickAmount' => 3,
                'decimalsInFloat' => 0,
                'min' => 0
            ]
        ];
        // BOOKING CHART DATA OPTIONS END______________

        // APPPOINTMENT CHART DATA OPTIONS START______________
        // Retrieve events of the current user with bookings within the current month
        $services = auth()->user()->services()
        ->with(['appointments' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        }])
        ->get();

        // Initialize an array to store booking counts by day
        $appointmentCountsByDay = [];
        $lastServices = [];

        // Loop through each event and count Services by day
        foreach ($services as $service) {
            foreach ($service->appointments as $appointment) {
                $day = Carbon::parse($appointment->created_at)->format('Y-m-d');
                if (!isset($appointmentCountsByDay[$day])) {
                    $appointmentCountsByDay[$day] = 1;
                } else {
                    $appointmentCountsByDay[$day]++;
                }
            }
        }

        // Format data for ApexCharts
        $categories = [];
        $data = [];

        foreach ($appointmentCountsByDay as $day => $count) {
            $categories[] = $day;
            $data[] = $count;
        }

        // Construct options for ApexCharts
        $optionsAppointments = [
            'chart' => [
                'type' => 'bar',
                'height' => '400px'
            ],
            'series' => [
                [
                    'name' => 'Appointments',
                    'data' => $data,
                    'color' => '#1642B9'
                ]
            ],
            'xaxis' => [
                'categories' => $categories
            ],
            'yaxis' => [
                'tickAmount' => 3,
                'decimalsInFloat' => 0,
                'min' => 0
            ]
        ];
        // APPPOINTMENT CHART DATA OPTIONS END______________

        // Retrieve user events where event date is today or in the future
        $today = Carbon::today();
        $userComingEvents = auth()->user()->events()->whereDate('date', '>=', $today)->get();

        // Retrieve the last 10 bookings for the user's events
        $lastBookings = auth()->user()->events()
            ->with('bookings') // Load bookings for each event
            ->get()
            ->flatMap(function ($event) {
                return $event->bookings->take(-10); // Take last 10 bookings
            })
            ->sortByDesc('created_at'); // Sort by creation date

        
       
        return view('home', compact('totalEventsCount', 'totalAppointments', 'totalServicesCount', 'totalBookingsCount', 'options', 'optionsBookings', 'userComingEvents', 'lastBookings', 'serviceOptions', 'optionsAppointments'));
    }
}