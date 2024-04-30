<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WorkingHoursController extends Controller
{
    //
    public function update(Request $request, $id)
    {
        try {
            // Step 1: Retrieve the user
            $user = User::findOrFail($id);

            // Step 2: Iterate over the startHour and endHour arrays
            foreach ($request->startHour as $day => $startHour) {
                // Extract the corresponding endHour for the current day
                echo $startHour . ' ' . $request->endHour[$day] . '<br>';
                $endHour = $request->endHour[$day];

                // Step 3: Update or create the user's working hours for the current day
                $user->workingHours()->updateOrCreate(
                    ['day' => $day], // Where clause
                    ['start_hour' => $startHour, 'end_hour' => $endHour] // Data to update or create
                );
            }

            // Step 4: Save the changes to the user
            $user->save();
            return redirect()->back()->with('success', 'Working hours updated successfully.');
            // Optionally, return a response or redirect the user
            // return redirect()->route('workinghours.index')->with('success', 'Working hours updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', $e);
            // Log the error or handle it as needed
            // return back()->with('error', 'An error occurred while updating working hours.');
        }
    }
}