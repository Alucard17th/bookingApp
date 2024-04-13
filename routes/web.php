<?php

use Illuminate\Support\Facades\Route;
// Admin Controllers
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReviewController;

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

Route::get('/booking/{id}/{eventId}', [App\Http\Controllers\BookingController::class, 'indexFront'])->name('booking');

// Admin
Route::resource('events', EventController::class);
Route::resource('services', ServiceController::class);
Route::resource('bookings', BookingController::class);
Route::resource('profile', ProfileController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('appointments', AppointmentController::class);

// Front 
// SERVICES BOOKING 
Route::get('/book-service/{id}/{serviceId}', [App\Http\Controllers\FrontServiceController::class, 'index'])->name('front.service.book');
Route::post('/book-service', [App\Http\Controllers\FrontServiceController::class, 'store'])->name('front.service.booking.store');
Route::get('/service-booked-thanks-page', [App\Http\Controllers\FrontServiceController::class, 'thanks'])->name('front.service.booking.thanks');
Route::get('/get-appointments/{day}', [App\Http\Controllers\FrontServiceController::class, 'getAppointmentByDayAndTime'])->name('front.service.get.appointment');

// EVENTS BOOKING
Route::get('/book-event/{id}/{eventId}', [App\Http\Controllers\FrontEventController::class, 'index'])->name('front.event.book');
Route::post('/book-event', [App\Http\Controllers\FrontEventController::class, 'store'])->name('front.event.booking.store');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


Route::get('/user-subscription', [App\Http\Controllers\StripeController::class, 'getUserSubscription'])->name('get.user.subscription');


// STRIPE WEBHOOKS
Route::post('/webhook/customer-subscription-created', [App\Http\Controllers\StripeController::class, 'customerSubscriptionCreated'])->name('stripe.customer.subscription.created.webhook');