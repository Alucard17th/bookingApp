<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Paddle\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'logo',
        'avatar',
        'company_name',
        'description',
        'address',
        'phone',
        'consommation',
        'max_consommation',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    // public function subscription(){
    //     return $this->hasOne(Subscription::class, 'user_id');
    // }

    public function workingHours(){
        return $this->hasMany(WorkingHours::class, 'user_id');
    }

    public function breaks(){
        return $this->hasMany(Pause::class, 'user_id');
    }

    public function timeoff(){
        return $this->hasMany(TimeOff::class, 'user_id');  
    }

    // public function canReceiveBookings(){
    //     $events = $this->events;
    //     $bookings = collect();
    //     // Loop through each service
    //     foreach ($events as $event) {
    //         // Retrieve the bookings associated with the current event using eager loading
    //         $eventBookings = $event->bookings()->get();
    //         // Merge the bookings into the $bookings collection
    //         $bookings = $bookings->merge($eventBookings);
    //     }

    //     $services = $this->services;
    //     $appointments = collect();
    //     // Loop through each service
    //     foreach ($services as $service) {
    //         // Retrieve the appointments associated with the current service using eager loading
    //         $serviceAppointments = $service->appointments()->get();
    //         // Merge the appointments into the $appointments collection
    //         $appointments = $appointments->merge($serviceAppointments);
    //     }
        
    //     $consommation = $bookings->count() + $appointments->count();
    //     $consommation_limit = $this->subscription->bookings;

    //     if($consommation < $consommation_limit){
    //         return true;
    //     }
    //     return false;
    // }

    public function canBeBooked(){
        $consommation = $this->consommation;
        $consommation_limit = $this->max_consommation;
        if($consommation >= $consommation_limit){
            return false;
        }
        return true;
    }

    public function product(){
        $price_id = $this->subscription()->items[0]->price_id;
        $product = Product::where('paddle_price_id', $price_id)->first();
        $features = json_decode($product->features);
        $name = $features->name;
        return $name;
    }
}
