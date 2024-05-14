<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pause;

class BreakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = auth()->user();
        $userWorkingHoursTest = $user->workingHours->all();
        $array = [];
        foreach($userWorkingHoursTest as $workingHour){
            foreach ($workingHour->breaks as $break) {
                $break->delete();
            }
        }
        // Get the startHour and endHour arrays from the request
        $startHours = $request->input('startHour');
        $endHours = $request->input('endHour');
        // Loop through each day
        foreach ($startHours as $day => $startTimes) {
            // Get the corresponding end times for the day
            $endTimes = $endHours[$day];
            $userWorkingHours = $user->workingHours->where('day', $day)->first();
            // Loop through each start time and end time pair for the day
            for ($i = 0; $i < count($startTimes); $i++) {
                // Create a new Break instance
                if($startTimes[$i] != null || $endTimes[$i] != null){
                    $break = new Pause();
                    $break->user_id = $id; // Assuming user_id is the foreign key for the user
                    $break->start_time = $startTimes[$i];
                    $break->end_time = $endTimes[$i];
                    $break->working_hour_id = $userWorkingHours->id;
                    $break->day = $day;
                    // Save the break
                    $break->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Breaks updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
