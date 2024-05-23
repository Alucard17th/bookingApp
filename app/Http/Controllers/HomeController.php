<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Product;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

    public function listServices(){
        $priceId = Product::where('name', 'Basic')->first()->paddle_price_id;
        $subscribedUsers = User::whereHas('subscriptions', function ($query) use ($priceId) {
            $query->whereHas('items', function ($query) use ($priceId) {
                $query->whereNot('price_id', $priceId);
            });
        })->pluck('id')->toArray();
        $services = Service::whereIn('user_id', $subscribedUsers)->paginate(8);

        return view('front.services', compact('services'));
    }

    public function searchServices(Request $request)
    {
        $filters = $request->all(); // Get all filter parameters

        $query = Service::query();

        // Filter by location (if provided)
        if (isset($filters['locationFilter']) && $filters['locationFilter'] !== '') {
            $query->where('location', $filters['locationFilter']);
        }

        // Filter by minimum duration (if provided)
        if (isset($filters['durationFilter']) && $filters['durationFilter'] !== '') {
            $query->where('duration', '>=', $filters['durationFilter']);
        }

        // Filter by maximum duration (if provided)
        if (isset($filters['durationFilter']) && $filters['durationFilter'] !== '') {
            $query->where('duration', '<=', $filters['durationFilter']);
        }

        // Filter by cost range (if provided)
        if (isset($filters['costFilterMin']) && isset($filters['costFilterMax'])) {
            $query->whereBetween('cost', [$filters['costFilterMin'], $filters['costFilterMax']]);
        }

        $services = $query->paginate(10); // Paginate results (optional)
        return view('front.services', compact('services'));
    }

    public function showService($id)
    {
        $service = Service::find($id);
        return view('front.service', compact('service'));
    }

    public function privacy(){
        return view('front.privacy-policy');
    }

    public function terms(){
        return view('front.terms-of-use');
    }

    public function about(){
        return view('front.about');
    }
}