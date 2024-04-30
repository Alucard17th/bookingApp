<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'day', 'start_hour', 'end_hour', 'break_start', 'break_end', 'time_off'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function breaks()
    {
        return $this->hasMany(Pause::class, 'working_hour_id');
    }
}
