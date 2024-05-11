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
}
