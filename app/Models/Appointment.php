<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'date', 'time', 'service_id', 'status'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function getStartTime(){
        $timeString = $this->time; // Assuming $appointment is your object

        // $timeParts = explode('-', $timeString);

        // $startTime = strtotime($timeParts[0]);
        // $endTime = strtotime($timeParts[1]);

        // $startHour = date('H', $startTime); // Get hour in 24-hour format
        // $endHour = date('H', $endTime);

        return $timeString;
    }
}
