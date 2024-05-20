<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendAppointmentReminders extends Command
{
    protected $signature = 'reminders:send';

    protected $description = 'Send appointment reminders one day before the appointment date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $appointments = Appointment::whereDate('date', $tomorrow)->where('status', 'active')->get();

        foreach ($appointments as $appointment) {
            // Send email reminder
            Mail::raw("This is a reminder for your appointment scheduled on {$appointment->date} at {$appointment->time}.", function ($message) use ($appointment) {
                $message->to($appointment->email)
                        ->subject('Appointment Reminder');
            });

            $this->info("Reminder sent to: {$appointment->email}");
        }
    }
}
