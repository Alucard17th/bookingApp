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

// Admin
Route::resource('events', EventController::class);
Route::resource('services', ServiceController::class);
Route::resource('bookings', BookingController::class);
Route::resource('profile', ProfileController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('calendars', CalendarController::class);

Route::get('/appointments-calendar', [App\Http\Controllers\CalendarController::class, 'indexAppointments'])->name('user.appointments.calendar');
Route::get('/user-appointments-json', [App\Http\Controllers\AppointmentController::class, 'indexJson'])->name('user.appointments.json');

Route::get('/events-calendar', [App\Http\Controllers\CalendarController::class, 'indexEvents'])->name('user.events.calendar');
Route::get('/user-events-json', [App\Http\Controllers\EventController::class, 'indexJson'])->name('user.events.json');

// Front 
Route::middleware(['middleware' => 'canUserReceiveBookings'])->group(function () {
    // SERVICES BOOKING 
    Route::get('/book-service/{id}/{serviceId}', [App\Http\Controllers\FrontServiceController::class, 'index'])->name('front.service.book');
    // EVENTS BOOKING
    Route::get('/book-event/{id}/{eventId}', [App\Http\Controllers\FrontEventController::class, 'index'])->name('front.event.book');
});

// SERVICES BOOKING 
Route::post('/book-service', [App\Http\Controllers\FrontServiceController::class, 'store'])->name('front.service.booking.store');
Route::get('/service-booked-thanks-page', [App\Http\Controllers\FrontServiceController::class, 'thanks'])->name('front.service.booking.thanks');
Route::get('/get-appointments/{day}', [App\Http\Controllers\FrontServiceController::class, 'getAppointmentByDayAndTime'])->name('front.service.get.appointment');
// EVENTS BOOKING
Route::post('/book-event', [App\Http\Controllers\FrontEventController::class, 'store'])->name('front.event.booking.store');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/user-subscription', [App\Http\Controllers\StripeController::class, 'getUserSubscription'])->name('get.user.subscription');
// STRIPE WEBHOOKS
Route::post('/webhook/customer-subscription-created', [App\Http\Controllers\StripeController::class, 'customerSubscriptionCreated'])->name('stripe.customer.subscription.created.webhook');

Route::any('/stripe-webhook', [App\Http\Controllers\StripeController::class, 'handle'])->name('stripe.subscription.created.webhook');
Route::get('/subscribe', [App\Http\Controllers\StripeController::class, 'createCheckoutSession'])->name('subscribe');
Route::get('/checkout/success', [App\Http\Controllers\StripeController::class, 'checkoutSessionSuccess'])->name('checkout.success');
Route::get('/checkout/cancel', [App\Http\Controllers\StripeController::class, 'checkoutSessionCancel'])->name('checkout.cancel');
