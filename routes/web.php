<?php

use Illuminate\Support\Facades\Route;
// Admin Controllers
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\BreakController;
use App\Http\Controllers\TimeOffController;
use App\Models\Product;
//Front Controllers
use App\Http\Controllers\FrontServiceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('front.index');
});

Route::get('/choose-plan', function () {
    $products = Product::where('name', '!=', 'Free')->orderBy('bookings', 'asc')->get();
    $freeProducts = Product::where('name', 'Free')->get();
    return view('front.choose-plan', compact('products', 'freeProducts'));
})->name('choose.plan');

// Admin
Route::middleware(['middleware' => 'checkSubscription'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('events', EventController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('calendars', CalendarController::class);
    Route::resource('breaks', BreakController::class);
    Route::resource('timeoffs', TimeOffController::class);

    Route::put('workinghours/{id}', 'App\Http\Controllers\WorkingHoursController@update')->name('workinghours.update');
});

Route::resource('reviews', ReviewController::class);

Route::get('/appointments-calendar', [App\Http\Controllers\CalendarController::class, 'indexAppointments'])->name('user.appointments.calendar');
Route::get('/user-appointments-json', [App\Http\Controllers\AppointmentController::class, 'indexJson'])->name('user.appointments.json');
Route::get('/events-calendar', [App\Http\Controllers\CalendarController::class, 'indexEvents'])->name('user.events.calendar');
Route::get('/user-events-json', [App\Http\Controllers\EventController::class, 'indexJson'])->name('user.events.json');
Route::post('/user-service-json', [App\Http\Controllers\FrontServiceController::class, 'getUserService'])->name('getUserService');

// Front 
Route::middleware(['middleware' => 'canUserReceiveBookings'])->group(function () {
    // SERVICES BOOKING 
    Route::get('/service-demo/{id}', [App\Http\Controllers\FrontServiceController::class, 'indexNew'])->name('front.service.new.book');
    Route::get('/book-service/{id}/{serviceId}', [App\Http\Controllers\FrontServiceController::class, 'index'])->name('front.service.book');
    // EVENTS BOOKING
    Route::get('/book-event/{id}/{eventId}', [App\Http\Controllers\FrontEventController::class, 'index'])->name('front.event.book');
});

// SERVICES BOOKING 
Route::post('/book-service', [App\Http\Controllers\FrontServiceController::class, 'store'])->name('front.service.booking.store');
Route::get('/service-booked-thanks-page', [App\Http\Controllers\FrontServiceController::class, 'thanks'])->name('front.service.booking.thanks');
Route::get('/check-availability/{day}', [App\Http\Controllers\FrontServiceController::class, 'checkAvailability'])->name('front.service.get.appointment');
// EVENTS BOOKING
Route::post('/book-event', [App\Http\Controllers\FrontEventController::class, 'store'])->name('front.event.booking.store');

Auth::routes();

Route::get('/user-subscription', [App\Http\Controllers\StripeController::class, 'getUserSubscription'])->name('get.user.subscription');
// STRIPE WEBHOOKS
Route::post('/webhook/customer-subscription-created', [App\Http\Controllers\StripeController::class, 'customerSubscriptionCreated'])->name('stripe.customer.subscription.created.webhook');
Route::get('/subscribe/{product_id}', [App\Http\Controllers\StripeController::class, 'createCheckoutSession'])->name('subscribe.create.checkout.session');
Route::any('/stripe-webhook', [App\Http\Controllers\StripeController::class, 'handle'])->name('stripe.subscription.created.webhook');
// Route::get('/subscribe', [App\Http\Controllers\StripeController::class, 'createCheckoutSession'])->name('subscribe');
Route::get('/checkout/success', [App\Http\Controllers\StripeController::class, 'checkoutSessionSuccess'])->name('checkout.success');
Route::get('/checkout/cancel', [App\Http\Controllers\StripeController::class, 'checkoutSessionCancel'])->name('checkout.cancel');


// IMPORT PRODUCTS FEATURES
Route::get('/import-plans-features', function () {
    $freeProducts = Product::where('name', 'Free')->get();
    $features = [
        [   
            "id" => 2,
            "name" => "Free",
            "admin_dashboard" => 1,
            "white_label" => 0,
            "list_in_booked_directory" => 0,
            "widget" => 1,
            "services_and_events_providers" => 1
        ],
        [
            "id" => 3,
            "name" => "Basic",
            "admin_dashboard" => 1,
            "white_label" => 0,
            "list_in_booked_directory" => 1,
            "widget" => 1,
            "services_and_events_providers" => 5
        ],
        [
            "id" => 1,
            "name" => "Standard",
            "admin_dashboard" => 1,
            "white_label" => 0,
            "list_in_booked_directory" => 1,
            "widget" => 1,
            "services_and_events_providers" => 15
        ],
        [
            "id" => 4,
            "name" => "Premium",
            "admin_dashboard" => 1,
            "white_label" => 1,
            "list_in_booked_directory" => 1,
            "widget" => 1,
            "services_and_events_providers" => 30
        ]
    ];
    try{
        foreach($features as $feature) {
            $product = Product::find($feature['id']);
            $product->features = json_encode($feature);
            $product->save();
        }
        dd('ok');
    }catch(Exception $e) {
        dd($e);
    }
});