<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }

    public function getImagePathAttribute()
    {
        return $this->image ? asset('images/services/'. $this->user_id . '/' . $this->image) : null;
    }

}
