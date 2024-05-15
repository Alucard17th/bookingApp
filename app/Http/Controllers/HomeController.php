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
        // Initialize variables to store total counts
        $totalServicesCount = auth()->user()->services->count();
        $services = auth()->user()->services;
        $totalAppointments = 0;
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Loop through each service
        foreach ($services as $service) {
            $totalAppointments += $service->appointments()->count();
        }


        // SERVICE CHART DATA OPTIONS START______________
        // Retrieve events of the current month
        $services = auth()->user()->services;
        $categories = [];
        $data = [];
        $serviceCounts = $services->groupBy(function ($service) {
            return Carbon::parse($service->created_at)->format('Y-m-d');
        });
        $serviceCounts = $serviceCounts->sortBy(function ($collection, $date) {
            return Carbon::parse($date);
        });
        $serviceCountsArray = $serviceCounts->map(function ($collection) {
            return $collection->count();
          })->toArray();
        foreach ($serviceCountsArray as $day => $count) {
            $categories[] = $day;
            $data[] = $count;
        }
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


        // APPPOINTMENT CHART DATA OPTIONS START______________
        $services = auth()->user()->services()
            ->with(['appointments' => function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            }])
        ->get();
        $appointmentCountsByDate = [];
        $cancelledAppointments = 0;
        $activeAppointments = 0;
        foreach ($services as $service) {
            $appointments = $service->appointments; // Access appointments collection
            $activeAppointments += $service->appointments()->where('status', 'active')->get()->count();
            $cancelledAppointments += $service->appointments()->where('status', 'cancelled')->get()->count();
            // Group appointments by date (Y-m-d)
            $appointmentCounts = $appointments->groupBy(function ($appointment) {
                return Carbon::parse($appointment->created_at)->format('Y-m-d');
            })->map(function ($collection) {
                return $collection->count(); // Count appointments per day
            })->toArray();
            // Merge appointment counts for this service into the main array
            $appointmentCountsByDate = array_merge($appointmentCountsByDate, $appointmentCounts);
        }
        ksort($appointmentCountsByDate);
        $categories = array_keys($appointmentCountsByDate);
        $data = array_values($appointmentCountsByDate);
        $optionsAppointments = [
            'chart' => [
                'type' => 'bar',
                'height' => '400px'
            ],
            'series' => [
                [
                    'name' => 'Appointments',
                    'data' => $data,
                    'color' => 'rgb(22, 66, 185)'
                ]
            ],
            'xaxis' => [
                'categories' => $categories
            ],
            'yaxis' => [
                'tickAmount' => 3,
                'decimalsInFloat' => 0,
                'min' => 0
            ],
        ];
        // APPPOINTMENT CHART DATA OPTIONS END______________

        // APPOINTEMENTS BY STATUS CHART DATA OPTIONS START______________
        $appointmentsByStatus = [
            'chart' => [
                'type' => 'pie',
                'height' => '400px'
            ],
            'series' => [$activeAppointments, $cancelledAppointments],
            'labels' => ['Active', 'Cancelled'],
            'colors' => ['#1642B9', '#EE7B11']
        ];
        // APPOINTEMENTS BY STATUS CHART DATA OPTIONS END______________
        
        // Retrieve the last 10 bookings for the user's events
        $lastAppointments = auth()->user()->services()
            ->with('appointments') // Load bookings for each event
            ->get()
            ->flatMap(function ($service) {
                return $service->appointments; // Take last 10 bookings
            })
            ->sortByDesc('created_at')->take(6); // Sort by creation date
       
        return view('home', compact('totalServicesCount', 'totalAppointments', 'serviceOptions', 'optionsAppointments', 'lastAppointments', 'appointmentsByStatus'));
    }
}